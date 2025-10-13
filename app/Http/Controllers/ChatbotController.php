<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Parsedown;

// Import semua model yang ada
use App\Models\JasaKonstruksi;
use App\Models\Manufacturing;
use App\Models\JasaNonKonstruksi;
use App\Models\CapexProcurement;
use App\Models\InternalProject;
use App\Models\Faq;
use App\Models\FaqJasaKonstruksi;
use App\Models\FaqJasaKonstruksiPsModule;
use App\Models\FaqJasaKonstruksiMmModule;
use App\Models\FaqJasaKonstruksiFiModule;
use App\Models\FaqJasaKonstruksiCoFmModule;
use App\Models\FaqJasaKonstruksiSdModule;
use App\Models\FaqManufacturing;
use App\Models\FaqJasaNonKonstruksi;
use App\Models\FaqCapexProcurement;
use App\Models\FaqInternalProject;
use App\Models\ChatHistory; // Tambahkan model ChatHistory

use Sastrawi\Stemmer\StemmerFactory;

class ChatbotController extends Controller
{
    protected $apiKey;
    protected $apiUrl;
    protected $parsedown;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->apiUrl = config('services.gemini.api_url');
        $this->parsedown = new Parsedown();
        
        // Pengaturan Parsedown
        $this->parsedown->setSafeMode(true); // Hindari XSS
        $this->parsedown->setBreaksEnabled(true); // Konversi line breaks
    }

    public function index()
    {
        return view('chatbot');
    }

    public function getResponse(Request $request)
    {
        $userMessage = $request->input('message');

        // Cek apakah ini adalah permintaan sesi baru
        $isNewSession = $request->input('is_new_session', false);
        
        // Generate atau gunakan session_id yang ada
        $sessionId = $request->input('session_id');

        // Jika session ID kosong atau tidak valid, atau merupakan sesi baru, buat session ID baru
        if (!$sessionId || $isNewSession) {
            $sessionId = Str::uuid()->toString();
        }
        
        // Cari data terkait di database
        // $relatedData = $this->findRelatedData($userMessage);
        $relatedData = $this->handleModel($userMessage);
        
        
        // Konteks perusahaan dan data dari database
        $contextPrompt = "Anda adalah chatbot resmi untuk PT. Adhi Karya. Perusahaan ini bergerak di berbagai bidang seperti konstruksi, manufacturing, jasa, dan proyek internal. ";
        
        // Tambahkan data dari database ke prompt jika ada
        if (!empty($relatedData)) {
            $contextPrompt .= "Berikut adalah data terkait yang relevan: " . json_encode($relatedData);
        }

        $fullPrompt = $contextPrompt . " Pertanyaan pengguna: " . $userMessage . 
                    " Gunakan data yang disediakan untuk memberikan jawaban yang akurat dan informatif.";

        try {
            $response = $this->callGeminiAPI($fullPrompt);

            // Jika ini sesi baru, selalu generate judul baru
            $sessionTitle = $isNewSession 
                ? $this->generateSessionTitle($userMessage) 
                : (ChatHistory::where('session_id', $sessionId)
                    ->whereNotNull('session_title')
                    ->value('session_title') ?? $this->generateSessionTitle($userMessage));
            
            // Simpan riwayat obrolan
            $chatHistory = ChatHistory::create([
                'user_id' => auth()->id ?? null,
                'session_id' => $sessionId,
                'user_message' => $userMessage,
                'bot_response' => $response,
                'session_title' => $sessionTitle
            ]);
            
            return response()->json([
                'message' => $response,
                'data' => $relatedData,
                'session_id' => $sessionId,
                'session_title' => $sessionTitle,
                'is_new_session' => $isNewSession
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot Error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Maaf, saat ini saya sedang mengalami kendala. Silakan coba lagi nanti.'
            ], 500);
        }
    }

    public function getChatSessions()
    {
        $sessions = ChatHistory::select('session_id', 'created_at', 'session_title')
            ->groupBy('session_id', 'created_at', 'session_title')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($session) {
                return Carbon::parse($session->created_at)->format('Y-m-d');
            })
            ->map(function($dailySessions, $date) {
                $groupedSessions = collect($dailySessions)->groupBy('session_title');
                
                $processedSessions = [];
                
                $groupedSessions->each(function($titleSessions) use (&$processedSessions) {
                    $firstSession = $titleSessions->first();
                    
                    // Ubah format tanggal dengan hari, tanggal, bulan singkat, tahun, dan waktu
                    $formattedDateTime = Carbon::parse($firstSession->created_at)
                        ->locale('id') // Set locale ke id
                        ->translatedFormat('D, j M y | H.i');
                    
                    $processedSessions[] = [
                        'session_id' => $firstSession->session_id,
                        'title' => $firstSession->session_title ?? 'Obrolan Baru',
                        'date' => $formattedDateTime
                    ];
                });
                
                return $processedSessions;
            });
        
        return response()->json(collect($sessions)->flatten(1)->values());
    }

    protected function generateSessionTitle($firstMessage)
    {
        $words = explode(' ', $firstMessage);
        
        $titleWords = array_slice($words, 0, min(5, count($words)));
        
        // Ubah setiap kata menjadi Title Case (huruf depan kapital)
        $titleWords = array_map(function($word) {
            return ucwords(strtolower($word));
        }, $titleWords);
        
        $title = implode(' ', $titleWords);
        
        $title = substr($title, 0, 50);
        
        if (strlen($firstMessage) > strlen($title)) {
            $title .= '...';
        }
        
        return $title;
    }

    public function getChatHistory(Request $request)
    {
        $sessionId = $request->input('session_id');
        
        if (!$sessionId) {
            return response()->json(['error' => 'Session ID tidak diberikan'], 400);
        }

        $history = ChatHistory::where('session_id', $sessionId)
            ->orderBy('created_at', 'asc')
            ->get();
        
        return response()->json($history);
    }    

    public function deleteChatSession(Request $request)
    {
        $sessionId = $request->input('session_id');

        if (!$sessionId) {
            return response()->json(['error' => 'Session ID tidak diberikan'], 400);
        }

        try {
            ChatHistory::where('session_id', $sessionId)->delete();
            
            return response()->json([
                'message' => 'Sesi obrolan berhasil dihapus',
                'session_id' => $sessionId
            ]);
        } catch (\Exception $e) {
            Log::error('Delete Chat Session Error: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Gagal menghapus sesi obrolan'
            ], 500);
        }
    }

    public function handleModel($userMessage)
    {
        // Panggil server Python
        Log::info('handleModel Process '. $userMessage);

        $scriptPath = base_path('public/python/model_faq.py');
	$pythonPath = base_path('venv/bin/python3');
	Log::info([$scriptPath, $pythonPath]);
	$escapedMessage = escapeshellarg($userMessage);

	exec("$pythonPath $scriptPath $escapedMessage", $output);
	// exec("python python/model_faq.py " . escapeshellarg($userMessage), $output);

        // $command = escapeshellcmd('python python/model_faq.py "'.$userMessage.'"');
        // exec($command, $output, $status);

        // // Gabungkan output menjadi satu string
        // $response = implode("\n", $output);

        // // Parse JSON jika outputnya valid
        // $data = json_decode($output, true);

        Log::info('Pemberlajaran data', [
                'message' => $userMessage,
                'relate data' => $output
            ]);

        return response()->json($output);

        // if (json_last_error() === JSON_ERROR_NONE) {
        //     // sukses
        //     return response()->json($data);
        // } else {
        //     // gagal parsing
        //     return response()->json(['error' => 'Gagal baca hasil dari Python', 'raw_output' => $response]);
        // }

        
        // return response()->json($data);
    }

    private function findRelatedData($message)
    {
        $message = strtolower($message);
        $relatedData = [];

        // Model pencarian dengan kolom yang sama untuk semua
        $searchableModels = [
            [
                'model' => JasaKonstruksi::class,
                'name' => 'Jasa Konstruksi',
                'fields' => ['judul', 'input_process', 'output_process', 'pic', 't_code', 'proses', 'link_terkait', 'module']
            ],
            // [
            //     'model' => Manufacturing::class,
            //     'name' => 'Manufacturing',
            //     'fields' => ['judul', 'input_process', 'output_process', 'pic', 't_code', 'proses', 'link_terkait', 'module']
            // ],
            // [
            //     'model' => JasaNonKonstruksi::class,
            //     'name' => 'Jasa Non Konstruksi',
            //     'fields' => ['judul', 'input_process', 'output_process', 'pic', 't_code', 'proses', 'link_terkait', 'module']
            // ],
            // [
            //     'model' => CapexProcurement::class,
            //     'name' => 'Capex Procurement',
            //     'fields' => ['judul', 'input_process', 'output_process', 'pic', 't_code', 'proses', 'link_terkait', 'module']
            // ],
            // [
            //     'model' => InternalProject::class,
            //     'name' => 'Internal Project',
            //     'fields' => ['judul', 'input_process', 'output_process', 'pic', 't_code', 'proses', 'link_terkait', 'module']
            // ],
            [
                'model' => Faq::class,
                'name' => 'FAQ Umum',
                'fields' => ['question', 'answer']
            ],
            [
                'model' => FaqJasaKonstruksi::class,
                'name' => 'FAQ Jasa Konstruksi',
                'fields' => ['question', 'answer']
            ],
            [
                'model' => FaqJasaKonstruksiPsModule::class,
                'name' => 'FAQ Jasa Konstruksi PS Module',
                'fields' => ['question', 'answer']
            ],
            [
                'model' => FaqJasaKonstruksiMmModule::class,
                'name' => 'FAQ Jasa Konstruksi PS Module',
                'fields' => ['question', 'answer']
            ],
            [
                'model' => FaqJasaKonstruksiFiModule::class,
                'name' => 'FAQ Jasa Konstruksi PS Module',
                'fields' => ['question', 'answer']
            ],
            [
                'model' => FaqJasaKonstruksiCoFmModule::class,
                'name' => 'FAQ Jasa Konstruksi PS Module',
                'fields' => ['question', 'answer']
            ],
            [
                'model' => FaqJasaKonstruksiSdModule::class,
                'name' => 'FAQ Jasa Konstruksi PS Module',
                'fields' => ['question', 'answer']
            ],
            // [
            //     'model' => FaqManufacturing::class,
            //     'name' => 'FAQ Manufacturing',
            //     'fields' => ['question', 'answer']
            // ],
            // [
            //     'model' => FaqJasaNonKonstruksi::class,
            //     'name' => 'FAQ Jasa Non Konstruksi',
            //     'fields' => ['question', 'answer']
            // ],
            // [
            //     'model' => FaqCapexProcurement::class,
            //     'name' => 'FAQ Capex Procurement',
            //     'fields' => ['question', 'answer']
            // ],
            // [
            //     'model' => FaqInternalProject::class,
            //     'name' => 'FAQ Internal Project',
            //     'fields' => ['question', 'answer']
            // ],
        ];

        // Menghilangkan kata imbuhan
        $factory = new StemmerFactory();
        $stemmer = $factory->createStemmer();
        $message = strtolower($message);
        $stemmed = $stemmer->stem($message);

        // Menghilangkan kata penghubung
        $stopwords = ['yang', 'dan', 'dengan', 'untuk', 'adalah', 'di', 'ke', 'pada', 'ini', 'cara', 'apakah', 'bagaimana', 'apa', 'saja'];
        $words = explode(' ', strtolower($stemmed));
        
        $filtered = array_filter($words, function($word) use ($stopwords) {
            return !in_array($word, $stopwords);
        });
        ; 


        foreach ($searchableModels as $modelConfig) {
            $model = $modelConfig['model'];
            $query = $model::query();

            // foreach ($modelConfig['fields'] as $field) {
            //     $query->where($field, 'LIKE', "%{$message}%");
            // }

            // $query->where(function ($q) use ($modelConfig, $message) {
            //     foreach ($modelConfig['fields'] as $field) {
            //         // $q->orWhere($field, 'LIKE', '%' . $message . '%');
            //         $q->orWhereRaw("LOWER($field) LIKE ?", ['%' . $message . '%']);
            //     }
            // });

            $query->where(function ($q) use ($modelConfig, $filtered) {
                foreach ($modelConfig['fields'] as $field) {
                        foreach ($filtered as $word_filter) {
                            $q->orWhereRaw("LOWER($field) LIKE ?", ['%' . $word_filter . '%']);
                        }
                    // });
                }
            });

            $results = $query->get();

            if (!$results->isEmpty()) {
                $relatedData[$modelConfig['name']] = $results->toArray();
            }
        }

        Log::info('Pemberlajaran data', [
                'message' => $filtered,
                'relate data' => $relatedData,
                'query' => $query->toSql(), $query->getBindings()
            ]);

        return $relatedData;
    }

    private function callGeminiAPI($prompt)
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    'parts' => [
                        ['text' => $prompt]
                    ],
                    'role' => 'user'
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 1,
                    'topP' => 0.8,
                    'maxOutputTokens' => 1024
                ]
            ]);

            Log::info('Gemini API Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $result = $response->json();
                
                $responseText = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak dapat menjawab pertanyaan tersebut.';
                
                $responseHtml = $this->parsedown->text($responseText);
                
                return $responseHtml;
            } else {
                Log::error('Gemini API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                throw new \Exception('API request failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
            throw $e;
        }
    }
}

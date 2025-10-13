<?php

namespace App\Http\Controllers\Admin\Faq\FaqJasaNonKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaNonKonstruksi;
use App\Models\ActivityLog; // Import ActivityLog
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage
use Illuminate\Support\Str; // Penambahan Str

class GeneralController extends Controller
{
    /**
     * Tampilkan daftar FAQ General.
     */
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Default ke 10 jika tidak ada pilihan
        $searchTerm = $request->input('search', ''); // Inisialisasi variabel $searchTerm ke string kosong jika tidak ada input pencarian

        // Bangun query dengan filter pencarian jika ada
        $query = FaqJasaNonKonstruksi::query();
        
        if ($searchTerm) {
            $query->where('question', 'LIKE', "%{$searchTerm}%")
                ->orWhere('answer', 'LIKE', "%{$searchTerm}%");
        }

        // Ambil hasil berdasarkan jumlah entri per halaman
        $faqs = $query->paginate($entries)->appends($request->all());

        // Pastikan $searchTerm selalu ada, meskipun pencarian kosong
        return view('admin.faq.faq-jasa-non-konstruksi.general.index', compact('faqs', 'searchTerm'));
    }

    /**
     * Tampilkan form untuk membuat FAQ General baru.
     */
    public function create()
    {
        return view('admin.faq.faq-jasa-non-konstruksi.general.create');
    }

    /**
     * Simpan FAQ General baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input termasuk gambar
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional
        ]);

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $imageName = $originalName . '_' . time() . '.' . $extension;
            $image->move(public_path('images/faq-jasa-non-konstruksi'), $imageName); // Simpan gambar di folder public/images/faq-jasa-non-konstruksi/general
        }

        // Simpan FAQ ke database
        FaqJasaNonKonstruksi::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'image' => $imageName ?? null, // Simpan nama gambar ke database
        ]);

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menambahkan FAQ General Jasa Non Konstruksi: ' . $request->input('question'),
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('faq-jasa-non-konstruksi.general.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit untuk FAQ General.
     */
    public function edit(FaqJasaNonKonstruksi $faq)
    {
        return view('admin.faq.faq-jasa-non-konstruksi.general.edit', compact('faq'));
    }

    /**
     * Update FAQ General yang sudah ada di database.
     */
    public function update(Request $request, FaqJasaNonKonstruksi $faq)
    {
        // Validasi input, gambar opsional
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar tidak wajib
        ]);

        // Cek apakah ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($faq->image) {
                $oldImagePath = public_path('images/faq-jasa-non-konstruksi/' . $faq->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload gambar baru
            $image = $request->file('image');
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $imageName = $originalName . '_' . time() . '.' . $extension;
            $image->move(public_path('images/faq-jasa-non-konstruksi'), $imageName);
            $faq->image = $imageName;
        }

        // Update FAQ di database
        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        if (isset($faq->image)) {
            $faq->save(); // Simpan jika gambar diubah
        }

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin memperbarui FAQ General Jasa Non Konstruksi: ' . $faq->question,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('faq-jasa-non-konstruksi.general.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Hapus FAQ General dari database.
     */
    public function destroy(FaqJasaNonKonstruksi $faq)
    {
        // Hapus gambar dari storage
        if ($faq->image) {
            $oldImagePath = public_path('images/faq-jasa-non-konstruksi/' . $faq->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Hapus gambar dari direktori
            }
        }

        // Hapus FAQ dari database
        $faq->delete();

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menghapus FAQ General Jasa Non Konstruksi: ' . $faq->question,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('faq-jasa-non-konstruksi.general.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
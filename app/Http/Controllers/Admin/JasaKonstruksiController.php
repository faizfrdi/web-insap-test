<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JasaKonstruksi;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class JasaKonstruksiController extends Controller
{
    /**
     * Menampilkan daftar Jasa Konstruksi.
     */
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Default ke 10 jika tidak ada pilihan
        $searchTerm = $request->input('search', ''); // Inisialisasi variabel $searchTerm ke string kosong jika tidak ada input pencarian

        // Bangun query dengan filter pencarian jika ada
        $query = JasaKonstruksi::query();
        
        if ($searchTerm) {
            $query->where('judul', 'LIKE', "%{$searchTerm}%")
                ->orWhere('input_process', 'LIKE', "%{$searchTerm}%")
                ->orWhere('output_process', 'LIKE', "%{$searchTerm}%")  // Menambahkan pencarian untuk kolom output_process
                ->orWhere('urutan', 'LIKE', "%{$searchTerm}%")
                ->orWhere('module', 'LIKE', "%{$searchTerm}%")
                ->orWhere('pic', 'LIKE', "%{$searchTerm}%")  // Pencarian berdasarkan kolom pic
                ->orWhere('t_code', 'LIKE', "%{$searchTerm}%") // Pencarian berdasarkan kolom t_code
                ->orWhere('proses', 'LIKE', "%{$searchTerm}%") // Pencarian berdasarkan kolom proses
                ->orWhere('link_terkait', 'LIKE', "%{$searchTerm}%"); // Pencarian berdasarkan kolom link_terkait
        }        

        // Ambil hasil berdasarkan jumlah entri per halaman
        $jasaKonstruksis = $query->paginate($entries)->appends($request->all());

        return view('admin.jasa-konstruksi.index', compact('jasaKonstruksis', 'searchTerm'));
    }

    /**
     * Menampilkan form untuk membuat Jasa Konstruksi baru.
     */
    public function create()
    {
        return view('admin.jasa-konstruksi.create');
    }

    /**
     * Menyimpan Jasa Konstruksi baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'input_process' => 'required|string',
            'output_process' => 'required|string',
            'urutan' => 'required|string|max:10',
            'pic' => 'required|string|max:100',
            't_code' => 'required|string|max:255',
            'proses' => 'required|string',
            'link_terkait' => 'nullable|string',
            'module' => 'required|string|max:100|in:FI Module,SD Module,PS Module,CO/FM Module,MM Module',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload gambar utama
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/jasa_konstruksi'), $imageName);
        }

        JasaKonstruksi::create([
            'judul' => $request->input('judul'),
            'input_process' => $request->input('input_process'),
            'output_process' => $request->input('output_process'),
            'urutan' => $request->input('urutan'),
            'pic' => $request->input('pic'),
            't_code' => $request->input('t_code'),
            'proses' => $request->input('proses'),
            'link_terkait' => $request->input('link_terkait'),
            'module' => $request->input('module'),
            'image' => $imageName,
        ]);

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menambahkan Jasa Konstruksi baru: ' . $request->input('judul'),
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('jasa-konstruksi.index')->with('success', 'Jasa Konstruksi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk Jasa Konstruksi.
     */
    public function edit(JasaKonstruksi $jasa_konstruksi)
    {
        $jasa_konstruksi->input_process = preg_replace('/\\r\n/m',' ', $jasa_konstruksi->input_process);
        $jasa_konstruksi->output_process = preg_replace('/\\r\n/m',' ', $jasa_konstruksi->output_process);
        $jasa_konstruksi->proses = preg_replace('/\\r\n/m',' ', $jasa_konstruksi->proses);

        return view('admin.jasa-konstruksi.edit', compact('jasa_konstruksi'));
    }

    /**
     * Memperbarui data Jasa Konstruksi di dalam database.
     */
    public function update(Request $request, JasaKonstruksi $jasa_konstruksi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'input_process' => 'required|string',
            'output_process' => 'required|string',
            'urutan' => 'required|string|max:10',
            'pic' => 'required|string|max:100',
            't_code' => 'required|string|max:255',
            'proses' => 'required|string',
            'link_terkait' => 'nullable|string',
            'module' => 'required|string|max:100|in:FI Module,SD Module,PS Module,CO/FM Module,MM Module',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses update gambar utama
        if ($request->hasFile('image')) {
            if ($jasa_konstruksi->image) {
                $oldImagePath = public_path('images/jasa_konstruksi/' . $jasa_konstruksi->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/jasa_konstruksi'), $imageName);
            $jasa_konstruksi->image = $imageName;
        }

        $jasa_konstruksi->update([
            'judul' => $request->input('judul'),
            'input_process' => $request->input('input_process'),
            'output_process' => $request->input('output_process'),
            'urutan' => $request->input('urutan'),
            'pic' => $request->input('pic'),
            't_code' => $request->input('t_code'),
            'proses' => $request->input('proses'),
            'link_terkait' => $request->input('link_terkait'),
            'module' => $request->input('module'),
            'image' => $jasa_konstruksi->image,
        ]);

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin memperbarui Jasa Konstruksi: ' . $jasa_konstruksi->judul,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('jasa-konstruksi.index')->with('success', 'Jasa Konstruksi berhasil diperbarui.');
    }

    /**
     * Menghapus Jasa Konstruksi dari database.
     */
    public function destroy(JasaKonstruksi $jasa_konstruksi)
    {
        // Hapus gambar dari folder public/images/jasa_konstruksi
        if ($jasa_konstruksi->image) {
            $oldImagePath = public_path('images/jasa_konstruksi/' . $jasa_konstruksi->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);  // Menghapus file gambar
            }
        }

        // Hapus Jasa Konstruksi dari database
        $jasa_konstruksi->delete();

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menghapus Jasa Konstruksi: ' . $jasa_konstruksi->judul,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('jasa-konstruksi.index')->with('success', 'Jasa Konstruksi berhasil dihapus.');
    }

    /**
     * Menampilkan detail Jasa Konstruksi untuk admin.
     */
    public function showAdmin(JasaKonstruksi $jasa_konstruksi)
    {
        return view('admin.jasa-konstruksi.show', compact('jasa_konstruksi'));
    }
}
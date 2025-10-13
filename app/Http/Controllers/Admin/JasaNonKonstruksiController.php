<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JasaNonKonstruksi;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class JasaNonKonstruksiController extends Controller
{
    /**
     * Menampilkan daftar Jasa Non Konstruksi.
     */
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Default ke 10 jika tidak ada pilihan
        $searchTerm = $request->input('search', ''); // Inisialisasi variabel $searchTerm ke string kosong jika tidak ada input pencarian

        // Bangun query dengan filter pencarian jika ada
        $query = JasaNonKonstruksi::query();
        
        if ($searchTerm) {
            $query->where('judul', 'LIKE', "%{$searchTerm}%")
                ->orWhere('input_process', 'LIKE', "%{$searchTerm}%")
                ->orWhere('output_process', 'LIKE', "%{$searchTerm}%")
                ->orWhere('urutan', 'LIKE', "%{$searchTerm}%")
                ->orWhere('module', 'LIKE', "%{$searchTerm}%")
                ->orWhere('pic', 'LIKE', "%{$searchTerm}%")
                ->orWhere('t_code', 'LIKE', "%{$searchTerm}%")
                ->orWhere('proses', 'LIKE', "%{$searchTerm}%")
                ->orWhere('link_terkait', 'LIKE', "%{$searchTerm}%");
        }

        // Ambil hasil berdasarkan jumlah entri per halaman
        $jasaNonKonstruksis = $query->paginate($entries)->appends($request->all());

        return view('admin.jasa-non-konstruksi.index', compact('jasaNonKonstruksis', 'searchTerm'));
    }

    /**
     * Menampilkan form untuk membuat Jasa Non Konstruksi baru.
     */
    public function create()
    {
        return view('admin.jasa-non-konstruksi.create');
    }

    /**
     * Menyimpan Jasa Non Konstruksi baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'input_process' => 'required|string',
            'output_process' => 'required|string',
            'urutan' => 'required|string|max:10',
            'pic' => 'required|string|max:100',
            't_code' => 'required|string|max:50',
            'proses' => 'required|string',
            'link_terkait' => 'required|string',
            'module' => 'required|string|max:100|in:FI Module,SD Module,PS Module,CO/FM Module,MM Module',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload gambar utama
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/jasa_non_konstruksi'), $imageName);
        }

        JasaNonKonstruksi::create([
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
            'activity' => 'Admin menambahkan Jasa Non Konstruksi baru: ' . $request->input('judul'),
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('jasa-non-konstruksi.index')->with('success', 'Jasa Non Konstruksi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk Jasa Non Konstruksi.
     */
    public function edit(JasaNonKonstruksi $jasa_non_konstruksi)
    {
        return view('admin.jasa-non-konstruksi.edit', compact('jasa_non_konstruksi'));
    }

    /**
     * Memperbarui data Jasa Non Konstruksi di dalam database.
     */
    public function update(Request $request, JasaNonKonstruksi $jasa_non_konstruksi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'input_process' => 'required|string',
            'output_process' => 'required|string',
            'urutan' => 'required|string|max:10',
            'pic' => 'required|string|max:100',
            't_code' => 'required|string|max:50',
            'proses' => 'required|string',
            'link_terkait' => 'required|string',
            'module' => 'required|string|max:100|in:FI Module,SD Module,PS Module,CO/FM Module,MM Module',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses update gambar utama
        if ($request->hasFile('image')) {
            if ($jasa_non_konstruksi->image) {
                $oldImagePath = public_path('images/jasa_non_konstruksi/' . $jasa_non_konstruksi->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/jasa_non_konstruksi'), $imageName);
            $jasa_non_konstruksi->image = $imageName;
        }

        $jasa_non_konstruksi->update([
            'judul' => $request->input('judul'),
            'input_process' => $request->input('input_process'),
            'output_process' => $request->input('output_process'),
            'urutan' => $request->input('urutan'),
            'pic' => $request->input('pic'),
            't_code' => $request->input('t_code'),
            'proses' => $request->input('proses'),
            'link_terkait' => $request->input('link_terkait'),
            'module' => $request->input('module'),
            'image' => $jasa_non_konstruksi->image,
        ]);

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin memperbarui Jasa Non Konstruksi: ' . $jasa_non_konstruksi->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('jasa-non-konstruksi.index')->with('success', 'Jasa Non Konstruksi berhasil diperbarui.');
    }

    /**
     * Menghapus Jasa Non Konstruksi dari database.
     */
    public function destroy(JasaNonKonstruksi $jasa_non_konstruksi)
    {
        // Hapus gambar dari folder public/images/jasa_non_konstruksi
        if ($jasa_non_konstruksi->image) {
            $oldImagePath = public_path('images/jasa_non_konstruksi/' . $jasa_non_konstruksi->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);  // Menghapus file gambar
            }
        }

        // Hapus Jasa Non Konstruksi dari database
        $jasa_non_konstruksi->delete();

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menghapus Jasa Non Konstruksi: ' . $jasa_non_konstruksi->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('jasa-non-konstruksi.index')->with('success', 'Jasa Non Konstruksi berhasil dihapus.');
    }

    /**
     * Menampilkan detail Jasa Non Konstruksi untuk admin.
     */
    public function showAdmin(JasaNonKonstruksi $jasa_non_konstruksi)
    {
        return view('admin.jasa-non-konstruksi.show', compact('jasa_non_konstruksi'));
    }
}
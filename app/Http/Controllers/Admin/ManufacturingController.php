<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturing;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ManufacturingController extends Controller
{
    /**
     * Menampilkan daftar Manufacturing.
     */
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Default ke 10 jika tidak ada pilihan
        $searchTerm = $request->input('search', ''); // Inisialisasi variabel $searchTerm ke string kosong jika tidak ada input pencarian

        // Bangun query dengan filter pencarian jika ada
        $query = Manufacturing::query();
        
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
        $manufacturings = $query->paginate($entries)->appends($request->all());

        return view('admin.manufacturing.index', compact('manufacturings', 'searchTerm'));
    }

    /**
     * Menampilkan form untuk membuat Manufacturing baru.
     */
    public function create()
    {
        return view('admin.manufacturing.create');
    }

    /**
     * Menyimpan Manufacturing baru ke dalam database.
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
            $image->move(public_path('images/manufacturing'), $imageName);
        }

        Manufacturing::create([
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
            'activity' => 'Admin menambahkan Manufacturing baru: ' . $request->input('judul'),
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('manufacturing.index')->with('success', 'Manufacturing berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk Manufacturing.
     */
    public function edit(Manufacturing $manufacturing)
    {
        return view('admin.manufacturing.edit', compact('manufacturing'));
    }

    /**
     * Memperbarui data Manufacturing di dalam database.
     */
    public function update(Request $request, Manufacturing $manufacturing)
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
            if ($manufacturing->image) {
                $oldImagePath = public_path('images/manufacturing/' . $manufacturing->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/manufacturing'), $imageName);
            $manufacturing->image = $imageName;
        }

        $manufacturing->update([
            'judul' => $request->input('judul'),
            'input_process' => $request->input('input_process'),
            'output_process' => $request->input('output_process'),
            'urutan' => $request->input('urutan'),
            'pic' => $request->input('pic'),
            't_code' => $request->input('t_code'),
            'proses' => $request->input('proses'),
            'link_terkait' => $request->input('link_terkait'),
            'module' => $request->input('module'),
            'image' => $manufacturing->image,
        ]);

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin memperbarui Manufacturing: ' . $manufacturing->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('manufacturing.index')->with('success', 'Manufacturing berhasil diperbarui.');
    }

    /**
     * Menghapus Manufacturing dari database.
     */
    public function destroy(Manufacturing $manufacturing)
    {
        // Hapus gambar dari folder public/images/manufacturing
        if ($manufacturing->image) {
            $oldImagePath = public_path('images/manufacturing/' . $manufacturing->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);  // Menghapus file gambar
            }
        }

        // Hapus Manufacturing dari database
        $manufacturing->delete();

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menghapus Manufacturing: ' . $manufacturing->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('manufacturing.index')->with('success', 'Manufacturing berhasil dihapus.');
    }

    /**
     * Menampilkan detail Manufacturing untuk admin.
     */
    public function showAdmin(Manufacturing $manufacturing)
    {
        return view('admin.manufacturing.show', compact('manufacturing'));
    }
}
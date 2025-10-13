<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternalProject;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InternalProjectController extends Controller
{
    /**
     * Menampilkan daftar Internal Project.
     */
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Default ke 10 jika tidak ada pilihan
        $searchTerm = $request->input('search', ''); // Inisialisasi variabel $searchTerm ke string kosong jika tidak ada input pencarian

        // Bangun query dengan filter pencarian jika ada
        $query = InternalProject::query();
        
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
        $internalProjects = $query->paginate($entries)->appends($request->all());

        return view('admin.internal-project.index', compact('internalProjects', 'searchTerm'));
    }

    /**
     * Menampilkan form untuk membuat Internal Project baru.
     */
    public function create()
    {
        return view('admin.internal-project.create');
    }

    /**
     * Menyimpan Internal Project baru ke dalam database.
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
            $image->move(public_path('images/internal_project'), $imageName);
        }

        InternalProject::create([
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
            'activity' => 'Admin menambahkan Internal Project baru: ' . $request->input('judul'),
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('internal-project.index')->with('success', 'Internal Project berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk Internal Project.
     */
    public function edit(InternalProject $internal_project)
    {
        return view('admin.internal-project.edit', compact('internal_project'));
    }

    /**
     * Memperbarui data Internal Project di dalam database.
     */
    public function update(Request $request, InternalProject $internal_project)
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
            if ($internal_project->image) {
                $oldImagePath = public_path('images/internal_project/' . $internal_project->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/internal_project'), $imageName);
            $internal_project->image = $imageName;
        }

        $internal_project->update([
            'judul' => $request->input('judul'),
            'input_process' => $request->input('input_process'),
            'output_process' => $request->input('output_process'),
            'urutan' => $request->input('urutan'),
            'pic' => $request->input('pic'),
            't_code' => $request->input('t_code'),
            'proses' => $request->input('proses'),
            'link_terkait' => $request->input('link_terkait'),
            'module' => $request->input('module'),
            'image' => $internal_project->image,
        ]);

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin memperbarui Internal Project: ' . $internal_project->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('internal-project.index')->with('success', 'Internal Project berhasil diperbarui.');
    }

    /**
     * Menghapus Internal Project dari database.
     */
    public function destroy(InternalProject $internal_project)
    {
        // Hapus gambar dari folder public/images/internal_project
        if ($internal_project->image) {
            $oldImagePath = public_path('images/internal_project/' . $internal_project->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);  // Menghapus file gambar
            }
        }

        // Hapus Internal Project dari database
        $internal_project->delete();

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menghapus Internal Project: ' . $internal_project->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('internal-project.index')->with('success', 'Internal Project berhasil dihapus.');
    }

    /**
     * Menampilkan detail Internal Project untuk admin.
     */
    public function showAdmin(InternalProject $internal_project)
    {
        return view('admin.internal-project.show', compact('internal_project'));
    }
}
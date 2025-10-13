<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CapexProcurement;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CapexProcurementController extends Controller
{
    /**
     * Menampilkan daftar Capex Procurement.
     */
    public function index(Request $request)
    {
        $entries = $request->input('entries', 10); // Default ke 10 jika tidak ada pilihan
        $searchTerm = $request->input('search', ''); // Inisialisasi variabel $searchTerm ke string kosong jika tidak ada input pencarian

        // Bangun query dengan filter pencarian jika ada
        $query = CapexProcurement::query();

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
        $capexProcurements = $query->paginate($entries)->appends($request->all());

        return view('admin.capex-procurement.index', compact('capexProcurements', 'searchTerm'));
    }

    /**
     * Menampilkan form untuk membuat Capex Procurement baru.
     */
    public function create()
    {
        return view('admin.capex-procurement.create');
    }

    /**
     * Menyimpan Capex Procurement baru ke dalam database.
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
            $image->move(public_path('images/capex_procurement'), $imageName);
        }

        CapexProcurement::create([
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
            'activity' => 'Admin menambahkan Capex Procurement baru: ' . $request->input('judul'),
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('capex-procurement.index')->with('success', 'Capex Procurement berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk Capex Procurement.
     */
    public function edit(CapexProcurement $capex_procurement)
    {
        return view('admin.capex-procurement.edit', compact('capex_procurement'));
    }

    /**
     * Memperbarui data Capex Procurement di dalam database.
     */
    public function update(Request $request, CapexProcurement $capex_procurement)
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
            if ($capex_procurement->image) {
                $oldImagePath = public_path('images/capex_procurement/' . $capex_procurement->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/capex_procurement'), $imageName);
            $capex_procurement->image = $imageName;
        }

        $capex_procurement->update([
            'judul' => $request->input('judul'),
            'input_process' => $request->input('input_process'),
            'output_process' => $request->input('output_process'),
            'urutan' => $request->input('urutan'),
            'pic' => $request->input('pic'),
            't_code' => $request->input('t_code'),
            'proses' => $request->input('proses'),
            'link_terkait' => $request->input('link_terkait'),
            'module' => $request->input('module'),
            'image' => $capex_procurement->image,
        ]);

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin memperbarui Capex Procurement: ' . $capex_procurement->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('capex-procurement.index')->with('success', 'Capex Procurement berhasil diperbarui.');
    }

    /**
     * Menghapus Capex Procurement dari database.
     */
    public function destroy(CapexProcurement $capex_procurement)
    {
        // Hapus gambar dari folder public/images/capex_procurement
        if ($capex_procurement->image) {
            $oldImagePath = public_path('images/capex_procurement/' . $capex_procurement->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);  // Menghapus file gambar
            }
        }

        // Hapus Capex Procurement dari database
        $capex_procurement->delete();

        // Tambahkan log aktivitas
        ActivityLog::create([
            'activity' => 'Admin menghapus Capex Procurement: ' . $capex_procurement->judul,
            'admin_id' => auth()->user()->id,
        ]);

        return redirect()->route('capex-procurement.index')->with('success', 'Capex Procurement berhasil dihapus.');
    }

    /**
     * Menampilkan detail Capex Procurement untuk admin.
     */
    public function showAdmin(CapexProcurement $capex_procurement)
    {
        return view('admin.capex-procurement.show', compact('capex_procurement'));
    }
}
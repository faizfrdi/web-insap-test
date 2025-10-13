<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FicoFm;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FicoFmController extends Controller
{
    private $imagePath = 'images/fico_fm';
    private $filePath = 'files/fico_fm';

    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $perPage = $request->input('entries', 10);

        $query = FicoFm::query();

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('report', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $reports = $query->orderByRaw("FIELD(status, 'done', 'on going')")
                         ->orderByDesc('updated_at')
                         ->orderByDesc('created_at')
                         ->paginate($perPage)
                         ->withQueryString();

        return view('admin.fico-fm.index', compact('reports', 'searchTerm'));
    }

    public function create()
    {
        return view('admin.fico-fm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'report' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        $data = $request->only(['report', 'status', 'description', 'link']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->imagePath), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($this->filePath), $fileName);
            $data['file'] = $fileName;
        }

        FicoFm::create($data);

        ActivityLog::create([
            'activity' => 'Admin menambahkan FICO/FM: ' . $data['report'],
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('fico-fm.index')->with('success', 'Updates berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fico_fm = FicoFm::findOrFail($id);
        $fico_fm->description = preg_replace('/\\r\\n/', ' ', $fico_fm->description);

        return view('admin.fico-fm.edit', compact('fico_fm'));
    }

    public function update(Request $request, $id)
    {
        $fico_fm = FicoFm::findOrFail($id);

        $request->validate([
            'report' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        $data = $request->only(['report', 'status', 'description', 'link']);

        if ($request->hasFile('image')) {
            $oldImage = public_path($this->imagePath . '/' . $fico_fm->image);
            if ($fico_fm->image && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->imagePath), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('file')) {
            $oldFile = public_path($this->filePath . '/' . $fico_fm->file);
            if ($fico_fm->file && file_exists($oldFile)) {
                unlink($oldFile);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($this->filePath), $fileName);
            $data['file'] = $fileName;
        }

        $fico_fm->update($data);

        ActivityLog::create([
            'activity' => 'Admin memperbarui FICO/FM: ' . $fico_fm->report,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('fico-fm.index')->with('success', 'Updates berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $report = FicoFm::findOrFail($id);

        $imagePath = public_path($this->imagePath . '/' . $report->image);
        if ($report->image && file_exists($imagePath)) {
            unlink($imagePath);
        }

        $filePath = public_path($this->filePath . '/' . $report->file);
        if ($report->file && file_exists($filePath)) {
            unlink($filePath);
        }

        $report->delete();

        ActivityLog::create([
            'activity' => 'Admin menghapus FICO/FM: ' . $report->report,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('fico-fm.index')->with('success', 'Updates berhasil dihapus.');
    }

    public function showAdmin($id)
    {
        $report = FicoFm::findOrFail($id);
        return view('admin.fico-fm.show', compact('report'));
    }

    public function showPublic($id)
    {
        $report = FicoFm::findOrFail($id);
        return view('info.fico-fm-detail', compact('report'));
    }
}
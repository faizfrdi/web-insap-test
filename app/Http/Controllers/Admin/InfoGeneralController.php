<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoGeneral;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InfoGeneralController extends Controller
{
    private $imagePath = 'images/info_general';
    private $filePath = 'files/info_general';

    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $perPage = $request->input('entries', 10);

        $query = InfoGeneral::query();

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

        return view('admin.info-general.index', compact('reports', 'searchTerm'));
    }

    public function create()
    {
        return view('admin.info-general.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'report' => 'required|string',
            'status' => 'required|string',
            'description' => 'required|string',
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

        InfoGeneral::create($data);

        ActivityLog::create([
            'activity' => 'Admin menambahkan Info General: ' . $data['report'],
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('info-general.index')->with('success', 'Updates berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $info_general = InfoGeneral::findOrFail($id);
        $info_general->description = preg_replace('/\\r\\n/', ' ', $info_general->description);

        return view('admin.info-general.edit', compact('info_general'));
    }

    public function update(Request $request, $id)
    {
        $info_general = InfoGeneral::findOrFail($id);

        $request->validate([
            'report' => 'required|string',
            'status' => 'required|string',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        $data = $request->only(['report', 'status', 'description', 'link']);

        if ($request->hasFile('image')) {
            $oldImage = public_path($this->imagePath . '/' . $info_general->image);
            if ($info_general->image && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->imagePath), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('file')) {
            $oldFile = public_path($this->filePath . '/' . $info_general->file);
            if ($info_general->file && file_exists($oldFile)) {
                unlink($oldFile);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($this->filePath), $fileName);
            $data['file'] = $fileName;
        }

        $info_general->update($data);

        ActivityLog::create([
            'activity' => 'Admin memperbarui Info General: ' . $info_general->report,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('info-general.index')->with('success', 'Updates berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $report = InfoGeneral::findOrFail($id);

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
            'activity' => 'Admin menghapus Info General: ' . $report->report,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('info-general.index')->with('success', 'Updates berhasil dihapus.');
    }

    public function showAdmin($id)
    {
        $report = InfoGeneral::findOrFail($id);
        return view('admin.info-general.show', compact('report'));
    }

    public function showPublic($id)
    {
        $report = InfoGeneral::findOrFail($id);
        return view('info.info-general-detail', compact('report'));
    }
}
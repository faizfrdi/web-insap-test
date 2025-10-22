<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mm;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MmController extends Controller
{
    private $imagePath = 'images/mm';
    private $filePath = 'files/mm';

    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');
        $perPage = $request->input('entries', 10);

        $query = Mm::query();

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

        return view('admin.mm.index', compact('reports', 'searchTerm'));
    }

    public function create()
    {
        return view('admin.mm.create');
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

        Mm::create($data);

        ActivityLog::create([
            'activity' => 'Admin menambahkan  MM: ' . $data['report'],
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('mm.index')->with('success', 'Updates berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mm = Mm::findOrFail($id);
        $mm->description = preg_replace('/\\r\\n/', ' ', $mm->description);

        return view('admin.mm.edit', compact('mm'));
    }

    public function update(Request $request, $id)
    {
        $mm = Mm::findOrFail($id);

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
            $oldImage = public_path($this->imagePath . '/' . $mm->image);
            if ($mm->image && file_exists($oldImage)) {
                unlink($oldImage);
            }

            $image = $request->file('image');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->imagePath), $imageName);
            $data['image'] = $imageName;
        }

        if ($request->hasFile('file')) {
            $oldFile = public_path($this->filePath . '/' . $mm->file);
            if ($mm->file && file_exists($oldFile)) {
                unlink($oldFile);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($this->filePath), $fileName);
            $data['file'] = $fileName;
        }

        $mm->update($data);

        ActivityLog::create([
            'activity' => 'Admin memperbarui MM: ' . $mm->report,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('mm.index')->with('success', 'Updates berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $report = Mm::findOrFail($id);

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
            'activity' => 'Admin menghapus MM: ' . $report->report,
            'admin_id' => Auth::user()->id,
        ]);

        return redirect()->route('mm.index')->with('success', 'Updates berhasil dihapus.');
    }

    public function showAdmin($id)
    {
        $report = Mm::findOrFail($id);
        return view('admin.mm.show', compact('report'));
    }

    public function showPublic($id)
    {
        $report = Mm::findOrFail($id);
        return view('info.mm-detail', compact('report'));
    }
}
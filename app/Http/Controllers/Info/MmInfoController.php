<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\Mm;
use Illuminate\Http\Request;

class MmInfoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');

        $query = Mm::query();

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Urutkan: done dulu, baru ongoing, lalu updated_at desc
        $query->orderByRaw("FIELD(status, 'done', 'on going')")
              ->orderByDesc('updated_at')
              ->orderByDesc('created_at');

        // Pagination (10 per halaman)
        $reports = $query->paginate(10)->appends(request()->query());

        return view('info.mm', compact('reports', 'status'));
    }
}
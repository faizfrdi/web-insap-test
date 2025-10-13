<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\Ps;
use Illuminate\Http\Request;

class PsInfoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('q');

        $query = Ps::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('report', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
            });
        }

        $query->orderByRaw("FIELD(status, 'done', 'on going')")
            ->orderByDesc('updated_at')
            ->orderByDesc('created_at');

        $reports = $query->paginate(10)->appends(request()->query());

        return view('info.ps', compact('reports', 'status', 'search'));
    }
}
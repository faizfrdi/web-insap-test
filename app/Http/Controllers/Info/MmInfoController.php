<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\Mm;
use Illuminate\Http\Request;

class MmInfoController extends Controller
{
    public function index(Request $request)
    {
        $selectedStatuses = $request->input('status', []); 
        $search = $request->input('q');

        $query = Mm::query();

        if (!empty($selectedStatuses)) {
            $validStatuses = array_intersect($selectedStatuses, ['done', 'on going']);
            
            if (!empty($validStatuses)) {
                $query->whereIn('status', $validStatuses);
            }
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

        $status = $request->input('status');
        return view('info.mm', compact('reports', 'status', 'search'));
    }
}
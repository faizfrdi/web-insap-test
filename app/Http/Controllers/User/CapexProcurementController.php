<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CapexProcurement;
use Illuminate\Http\Request;

class CapexProcurementController extends Controller
{
    // Fungsi untuk menampilkan halaman detail capex procurement berdasarkan slug
    public function showUser($slug)
    {
        $capex_procurement = CapexProcurement::where('slug', $slug)->firstOrFail();
        return view('scenarios.capex-procurement', compact('capex_procurement'));
    }
}
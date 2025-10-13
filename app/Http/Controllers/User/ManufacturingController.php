<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manufacturing;
use Illuminate\Http\Request;

class ManufacturingController extends Controller
{
    // Fungsi untuk menampilkan halaman detail manufacturing berdasarkan slug
    public function showUser($slug)
    {
        $manufacturing = Manufacturing::where('slug', $slug)->firstOrFail();
        return view('scenarios.manufacturing', compact('manufacturing'));
    }
}
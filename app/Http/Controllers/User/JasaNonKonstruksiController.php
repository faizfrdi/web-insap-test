<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JasaNonKonstruksi;
use Illuminate\Http\Request;

class JasaNonKonstruksiController extends Controller
{
    // Fungsi untuk menampilkan halaman detail jasa non konstruksi berdasarkan slug
    public function showUser($slug)
    {
        $jasa_non_konstruksi = JasaNonKonstruksi::where('slug', $slug)->firstOrFail();
        return view('scenarios.jasa-non-konstruksi', compact('jasa_non_konstruksi'));
    }
}
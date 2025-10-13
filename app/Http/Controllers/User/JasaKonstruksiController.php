<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JasaKonstruksi;
use Illuminate\Http\Request;

class JasaKonstruksiController extends Controller
{
    // Fungsi untuk menampilkan halaman detail jasa konstruksi berdasarkan slug
    public function showUser($slug)
    {
        $jasa_konstruksi = JasaKonstruksi::where('slug', $slug)->firstOrFail();
        return view('scenarios.jasa-konstruksi', compact('jasa_konstruksi'));
    }
}
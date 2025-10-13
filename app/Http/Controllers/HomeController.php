<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JasaKonstruksi;
use App\Models\Manufacturing;
use App\Models\JasaNonKonstruksi;
use App\Models\CapexProcurement;
use App\Models\InternalProject;
use App\Models\Visitor; // Model untuk pengunjung
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (home) dengan data dari lima bagian.
     * Serta menambahkan jumlah pengunjung ke database.
     */
    public function index()
    {
        // Logika untuk mencatat kunjungan setiap kali halaman ini diakses
        $today = Carbon::today();
        $visitor = Visitor::where('visit_date', $today)->first();

        if ($visitor) {
            // Jika sudah ada data pengunjung untuk hari ini, tambahkan jumlah pengunjung
            $visitor->increment('visit_count');
        } else {
            // Jika belum ada data untuk hari ini, buat data baru dengan kunjungan pertama
            Visitor::create([
                'visit_date' => $today,
                'visit_count' => 1
            ]);
        }

        // Mengambil data dari berbagai model untuk ditampilkan di halaman utama
        $jasaKonstruksis = JasaKonstruksi::all(); // Mengambil jasa konstruksi dengan pagination
        $manufacturings = Manufacturing::all(); // Mengambil data manufacturing dengan pagination
        $jasaNonKonstruksis = JasaNonKonstruksi::all(); // Mengambil jasa non konstruksi dengan pagination
        $capexProcurements = CapexProcurement::all(); // Mengambil capex procurement dengan pagination
        $internalProjects = InternalProject::all(); // Mengambil internal project dengan pagination

        // Mengirim data ke tampilan home.blade.php
        return view('home', compact(
            'jasaKonstruksis', 
            'manufacturings', 
            'jasaNonKonstruksis', 
            'capexProcurements', 
            'internalProjects'
        ));
    }
}
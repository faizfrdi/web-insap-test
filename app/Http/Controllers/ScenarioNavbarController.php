<?php

namespace App\Http\Controllers;

use App\Models\JasaKonstruksi;
use App\Models\Manufacturing;
use App\Models\JasaNonKonstruksi;
use App\Models\CapexProcurement;
use App\Models\InternalProject;

class ScenarioNavbarController extends Controller
{
    // Method untuk Jasa Konstruksi
    public function jasaKonstruksi()
    {
        $jasaKonstruksis = JasaKonstruksi::all(); // Menggunakan pagination dengan 3 item per halaman
        return view('scenario-navbar.jasa-konstruksi', compact('jasaKonstruksis'));
    }

    // Method untuk Manufacturing
    public function manufacturing()
    {
        $manufacturings = Manufacturing::all(); // Menggunakan pagination dengan 3 item per halaman
        return view('scenario-navbar.manufacturing', compact('manufacturings'));
    }

    // Method untuk Jasa Non Konstruksi
    public function jasaNonKonstruksi()
    {
        $jasaNonKonstruksis = JasaNonKonstruksi::all(); // Menggunakan pagination dengan 3 item per halaman
        return view('scenario-navbar.jasa-non-konstruksi', compact('jasaNonKonstruksis'));
    }

    // Method untuk Capex Procurement
    public function capexProcurement()
    {
        $capexProcurements = CapexProcurement::all(); // Menggunakan pagination dengan 3 item per halaman
        return view('scenario-navbar.capex-procurement', compact('capexProcurements'));
    }

    // Method untuk Internal Project
    public function internalProject()
    {
        $internalProjects = InternalProject::all(); // Menggunakan pagination dengan 3 item per halaman
        return view('scenario-navbar.internal-project', compact('internalProjects'));
    }
}
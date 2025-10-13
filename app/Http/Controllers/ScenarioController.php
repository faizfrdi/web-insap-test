<?php

namespace App\Http\Controllers;

use App\Models\JasaKonstruksi;
use App\Models\Manufacturing;
use App\Models\JasaNonKonstruksi;
use App\Models\CapexProcurement;
use App\Models\InternalProject;
use Illuminate\Http\Request;

class ScenarioController extends Controller
{
    // Method untuk menampilkan Jasa Konstruksi
    public function showJasaKonstruksi()
    {
        $jasaKonstruksi = JasaKonstruksi::paginate(3); // Mengambil data dan mengatur pagination
        return view('scenarios.jasa-konstruksi', compact('jasaKonstruksi'));
    }

    // Method untuk menampilkan Manufacturing
    public function showManufacturing()
    {
        $manufacturing = Manufacturing::paginate(3);
        return view('scenarios.manufacturing', compact('manufacturing'));
    }

    // Method untuk menampilkan Jasa Non Konstruksi
    public function showJasaNonKonstruksi()
    {
        $jasaNonKonstruksi = JasaNonKonstruksi::paginate(3);
        return view('scenarios.jasa-non-konstruksi', compact('jasaNonKonstruksi'));
    }

    // Method untuk menampilkan Capex Procurement
    public function showCapexProcurement()
    {
        $capexProcurement = CapexProcurement::paginate(3);
        return view('scenarios.capex-procurement', compact('capexProcurement'));
    }

    // Method untuk menampilkan Internal Project
    public function showInternalProject()
    {
        $internalProject = InternalProject::paginate(3);
        return view('scenarios.internal-project', compact('internalProject'));
    }
}

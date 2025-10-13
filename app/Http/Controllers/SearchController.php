<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqJasaKonstruksi;
use App\Models\FaqJasaKonstruksiPsModule;
use App\Models\FaqJasaKonstruksiMmModule;
use App\Models\FaqJasaKonstruksiFiModule;
use App\Models\FaqJasaKonstruksiCoFmModule;
use App\Models\FaqJasaKonstruksiSdModule;
use App\Models\FaqManufacturing;
use App\Models\FaqJasaNonKonstruksi;
use App\Models\FaqCapexProcurement;
use App\Models\FaqInternalProject;
use App\Models\JasaKonstruksi;
use App\Models\Manufacturing;
use App\Models\JasaNonKonstruksi;
use App\Models\CapexProcurement;
use App\Models\InternalProject;
use App\Models\FicoFm;
use App\Models\Ps;
use App\Models\Mm;
use App\Models\Sd;
use App\Models\InfoGeneral;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari input
        $query = $request->input('q'); 

        // Format query untuk pencarian fleksibel
        $formattedQuery = '%' . str_replace(' ', '%', $query) . '%';

        // Pencarian di tabel Jasa Konstruksi
        $jasaKonstruksis = JasaKonstruksi::where('judul', 'like', $formattedQuery)
                    ->orWhere('urutan', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel Manufacturing
        $manufacturings = Manufacturing::where('judul', 'like', $formattedQuery)
                    ->orWhere('urutan', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel Jasa Non Konstruksi
        $jasaNonKonstruksis = JasaNonKonstruksi::where('judul', 'like', $formattedQuery)
                    ->orWhere('urutan', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel Capex Procurement
        $capexProcurements = CapexProcurement::where('judul', 'like', $formattedQuery)
                    ->orWhere('urutan', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel Internal Project
        $internalProjects = InternalProject::where('judul', 'like', $formattedQuery)
                    ->orWhere('urutan', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ General
        $faqGenerals = Faq::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Jasa Konstruksi
        $faqJasaKonstruksis = FaqJasaKonstruksi::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();
 
        // Pencarian di tabel FAQ Jasa Konstruksi PS Module
        $faqJasaKonstruksisPs = FaqJasaKonstruksiPsModule::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();
        
        // Pencarian di tabel FAQ Jasa Konstruksi MM Module
        $faqJasaKonstruksisMm = FaqJasaKonstruksiMmModule::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Jasa Konstruksi FI Module
        $faqJasaKonstruksisFi = FaqJasaKonstruksiFiModule::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Jasa Konstruksi COFM Module
        $faqJasaKonstruksisCoFm = FaqJasaKonstruksiCoFmModule::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Jasa Konstruksi SD Module
        $faqJasaKonstruksisSd = FaqJasaKonstruksiSdModule::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Manufacturing
        $faqManufacturings = FaqManufacturing::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Jasa Non Konstruksi
        $faqJasaNonKonstruksis = FaqJasaNonKonstruksi::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Capex Procurement
        $faqCapexProcurements = FaqCapexProcurement::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FAQ Internal Project
        $faqInternalProjects = FaqInternalProject::where('question', 'like', $formattedQuery)
                    ->orWhere('answer', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel FICO / FM Reports
        $ficofmReports = FicoFm::where('report', 'like', $formattedQuery)
                    ->orWhere('status', 'like', $formattedQuery)
                    ->orWhere('description', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel PS Updates
        $psReports = Ps::where('report', 'like', $formattedQuery)
                    ->orWhere('status', 'like', $formattedQuery)
                    ->orWhere('description', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel MM Updates
        $mmReports = Mm::where('report', 'like', $formattedQuery)
                    ->orWhere('status', 'like', $formattedQuery)
                    ->orWhere('description', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel SD Updates
        $sdReports = Sd::where('report', 'like', $formattedQuery)
                    ->orWhere('status', 'like', $formattedQuery)
                    ->orWhere('description', 'like', $formattedQuery)
                    ->get();

        // Pencarian di tabel Info General Updates
        $infoGenerals = InfoGeneral::where('report', 'like', $formattedQuery)
                    ->orWhere('status', 'like', $formattedQuery)
                    ->orWhere('description', 'like', $formattedQuery)
                    ->get();

        Log::info('Pemberlajaran data', [
                'jasa konstruksi ps' => $faqJasaKonstruksisSd,
                'faq general' => $faqGenerals,
                'format query' => $formattedQuery
            ]);

        // Kirim hasil pencarian ke view
        return view('search-results', [
            'query' => $query,
            'jasaKonstruksis' => $jasaKonstruksis,
            'manufacturings' => $manufacturings,
            'jasaNonKonstruksis' => $jasaNonKonstruksis,
            'capexProcurements' => $capexProcurements,
            'internalProjects' => $internalProjects,
            'faqGenerals' => $faqGenerals,
            'faqJasaKonstruksis' => $faqJasaKonstruksis,
            'faqJasaKonstruksisPs' => $faqJasaKonstruksisPs,
            'faqJasaKonstruksisFi' => $faqJasaKonstruksisFi,
            'faqJasaKonstruksisCoFm' => $faqJasaKonstruksisCoFm,
            'faqJasaKonstruksisSd' => $faqJasaKonstruksisSd,
            'faqJasaKonstruksisMm' => $faqJasaKonstruksisMm,
            'faqManufacturings' => $faqManufacturings,
            'faqJasaNonKonstruksis' => $faqJasaNonKonstruksis,
            'faqCapexProcurements' => $faqCapexProcurements,
            'faqInternalProjects' => $faqInternalProjects,
            'ficofmReports' => $ficofmReports,
            'psReports' => $psReports,
            'mmReports' => $mmReports,
            'sdReports' => $sdReports,
            'infoGenerals' => $infoGenerals,
        ]);
    }
}
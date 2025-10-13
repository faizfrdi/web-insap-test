<?php

namespace App\Http\Controllers\Faq\FaqCapexProcurement;

use App\Http\Controllers\Controller;
use App\Models\FaqCapexProcurementCoFmModule;

class CoFmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Capex Procurement CO/FM Module.
     */
    public function index()
    {
        $faqCoFmModules = FaqCapexProcurementCoFmModule::all();
        return view('faq.faq-capex-procurement.faq-co-fm-module', compact('faqCoFmModules'));
    }
}
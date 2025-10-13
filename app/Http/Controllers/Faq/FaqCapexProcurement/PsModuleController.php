<?php

namespace App\Http\Controllers\Faq\FaqCapexProcurement;

use App\Http\Controllers\Controller;
use App\Models\FaqCapexProcurementPsModule;

class PsModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Capex Procurement PS Module.
     */
    public function index()
    {
        $faqPsModules = FaqCapexProcurementPsModule::all();
        return view('faq.faq-capex-procurement.faq-ps-module', compact('faqPsModules'));
    }
}
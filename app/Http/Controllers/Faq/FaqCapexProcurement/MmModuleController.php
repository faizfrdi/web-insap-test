<?php

namespace App\Http\Controllers\Faq\FaqCapexProcurement;

use App\Http\Controllers\Controller;
use App\Models\FaqCapexProcurementMmModule;

class MmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Capex Procurement MM Module.
     */
    public function index()
    {
        $faqMmModules = FaqCapexProcurementMmModule::all();
        return view('faq.faq-capex-procurement.faq-mm-module', compact('faqMmModules'));
    }
}
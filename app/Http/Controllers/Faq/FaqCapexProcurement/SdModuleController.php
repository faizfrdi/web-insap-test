<?php

namespace App\Http\Controllers\Faq\FaqCapexProcurement;

use App\Http\Controllers\Controller;
use App\Models\FaqCapexProcurementSdModule;

class SdModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Capex Procurement SD Module.
     */
    public function index()
    {
        $faqSdModules = FaqCapexProcurementSdModule::all();
        return view('faq.faq-capex-procurement.faq-sd-module', compact('faqSdModules'));
    }
}
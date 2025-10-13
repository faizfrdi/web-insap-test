<?php

namespace App\Http\Controllers\Faq\FaqCapexProcurement;

use App\Http\Controllers\Controller;
use App\Models\FaqCapexProcurementFiModule;

class FiModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Capex Procurement FI Module.
     */
    public function index()
    {
        $faqFiModules = FaqCapexProcurementFiModule::all();
        return view('faq.faq-capex-procurement.faq-fi-module', compact('faqFiModules'));
    }
}
<?php

namespace App\Http\Controllers\Faq\FaqManufacturing;

use App\Http\Controllers\Controller;
use App\Models\FaqManufacturingCoFmModule;

class CoFmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Manufacturing CO/FM Module.
     */
    public function index()
    {
        $faqCoFmModules = FaqManufacturingCoFmModule::all();
        return view('faq.faq-manufacturing.faq-co-fm-module', compact('faqCoFmModules'));
    }
}
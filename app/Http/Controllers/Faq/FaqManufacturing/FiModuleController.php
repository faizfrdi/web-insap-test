<?php

namespace App\Http\Controllers\Faq\FaqManufacturing;

use App\Http\Controllers\Controller;
use App\Models\FaqManufacturingFiModule;

class FiModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Manufacturing FI Module.
     */
    public function index()
    {
        $faqFiModules = FaqManufacturingFiModule::all();
        return view('faq.faq-manufacturing.faq-fi-module', compact('faqFiModules'));
    }
}
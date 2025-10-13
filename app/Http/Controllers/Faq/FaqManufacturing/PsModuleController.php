<?php

namespace App\Http\Controllers\Faq\FaqManufacturing;

use App\Http\Controllers\Controller;
use App\Models\FaqManufacturingPsModule;

class PsModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Manufacturing PS Module.
     */
    public function index()
    {
        $faqPsModules = FaqManufacturingPsModule::all();
        return view('faq.faq-manufacturing.faq-ps-module', compact('faqPsModules'));
    }
}
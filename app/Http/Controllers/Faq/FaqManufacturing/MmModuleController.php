<?php

namespace App\Http\Controllers\Faq\FaqManufacturing;

use App\Http\Controllers\Controller;
use App\Models\FaqManufacturingMmModule;

class MmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Manufacturing MM Module.
     */
    public function index()
    {
        $faqMmModules = FaqManufacturingMmModule::all();
        return view('faq.faq-manufacturing.faq-mm-module', compact('faqMmModules'));
    }
}
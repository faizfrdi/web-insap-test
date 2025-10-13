<?php

namespace App\Http\Controllers\Faq\FaqManufacturing;

use App\Http\Controllers\Controller;
use App\Models\FaqManufacturingSdModule;

class SdModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Manufacturing SD Module.
     */
    public function index()
    {
        $faqSdModules = FaqManufacturingSdModule::all();
        return view('faq.faq-manufacturing.faq-sd-module', compact('faqSdModules'));
    }
}
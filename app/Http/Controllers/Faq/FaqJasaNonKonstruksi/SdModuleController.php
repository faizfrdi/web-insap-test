<?php

namespace App\Http\Controllers\Faq\FaqJasaNonKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaNonKonstruksiSdModule;

class SdModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Non-Konstruksi SD Module.
     */
    public function index()
    {
        $faqSdModules = FaqJasaNonKonstruksiSdModule::all();
        return view('faq.faq-jasa-non-konstruksi.faq-sd-module', compact('faqSdModules'));
    }
}
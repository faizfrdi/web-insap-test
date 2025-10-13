<?php

namespace App\Http\Controllers\Faq\FaqJasaKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaKonstruksiSdModule;

class SdModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Konstruksi SD Module.
     */
    public function index()
    {
        $faqSdModules = FaqJasaKonstruksiSdModule::all();
        return view('faq.faq-jasa-konstruksi.faq-sd-module', compact('faqSdModules'));
    }
}
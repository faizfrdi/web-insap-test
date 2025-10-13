<?php

namespace App\Http\Controllers\Faq\FaqJasaNonKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaNonKonstruksiFiModule;

class FiModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Non-Konstruksi FI Module.
     */
    public function index()
    {
        $faqFiModules = FaqJasaNonKonstruksiFiModule::all();
        return view('faq.faq-jasa-non-konstruksi.faq-fi-module', compact('faqFiModules'));
    }
}
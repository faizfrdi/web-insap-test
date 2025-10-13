<?php

namespace App\Http\Controllers\Faq\FaqJasaKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaKonstruksiFiModule;

class FiModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Konstruksi FI Module.
     */
    public function index()
    {
        $faqFiModules = FaqJasaKonstruksiFiModule::all();
        return view('faq.faq-jasa-konstruksi.faq-fi-module', compact('faqFiModules'));
    }
}
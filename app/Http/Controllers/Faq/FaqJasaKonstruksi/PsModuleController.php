<?php

namespace App\Http\Controllers\Faq\FaqJasaKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaKonstruksiPsModule;

class PsModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Konstruksi PS Module.
     */
    public function index()
    {
        $faqPsModules = FaqJasaKonstruksiPsModule::all();
        return view('faq.faq-jasa-konstruksi.faq-ps-module', compact('faqPsModules'));
    }
}
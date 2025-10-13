<?php

namespace App\Http\Controllers\Faq\FaqJasaNonKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaNonKonstruksiPsModule;

class PsModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Non-Konstruksi PS Module.
     */
    public function index()
    {
        $faqPsModules = FaqJasaNonKonstruksiPsModule::all();
        return view('faq.faq-jasa-non-konstruksi.faq-ps-module', compact('faqPsModules'));
    }
}
<?php

namespace App\Http\Controllers\Faq\FaqJasaKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaKonstruksiCoFmModule;

class CoFmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Konstruksi CO/FM Module.
     */
    public function index()
    {
        $faqCoFmModules = FaqJasaKonstruksiCoFmModule::all();
        return view('faq.faq-jasa-konstruksi.faq-co-fm-module', compact('faqCoFmModules'));
    }
}
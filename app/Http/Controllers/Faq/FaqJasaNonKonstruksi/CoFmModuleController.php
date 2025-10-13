<?php

namespace App\Http\Controllers\Faq\FaqJasaNonKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaNonKonstruksiCoFmModule;

class CoFmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Non-Konstruksi CO/FM Module.
     */
    public function index()
    {
        $faqCoFmModules = FaqJasaNonKonstruksiCoFmModule::all();
        return view('faq.faq-jasa-non-konstruksi.faq-co-fm-module', compact('faqCoFmModules'));
    }
}
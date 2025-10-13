<?php

namespace App\Http\Controllers\Faq\FaqJasaNonKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaNonKonstruksiMmModule;

class MmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Non-Konstruksi MM Module.
     */
    public function index()
    {
        $faqMmModules = FaqJasaNonKonstruksiMmModule::all();
        return view('faq.faq-jasa-non-konstruksi.faq-mm-module', compact('faqMmModules'));
    }
}
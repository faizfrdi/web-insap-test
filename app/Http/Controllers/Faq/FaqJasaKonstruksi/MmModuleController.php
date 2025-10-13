<?php

namespace App\Http\Controllers\Faq\FaqJasaKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaKonstruksiMmModule;

class MmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Konstruksi MM Module.
     */
    public function index()
    {
        $faqMmModules = FaqJasaKonstruksiMmModule::all();
        return view('faq.faq-jasa-konstruksi.faq-mm-module', compact('faqMmModules'));
    }
}
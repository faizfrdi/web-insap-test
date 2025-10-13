<?php

namespace App\Http\Controllers\Faq\FaqJasaKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaKonstruksi;

class GeneralController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Konstruksi General.
     */
    public function index()
    {
        $faqJasaKonstruksis = FaqJasaKonstruksi::all();
        return view('faq.faq-jasa-konstruksi.faq-general', compact('faqJasaKonstruksis'));
    }
}
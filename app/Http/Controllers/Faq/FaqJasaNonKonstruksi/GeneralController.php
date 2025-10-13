<?php

namespace App\Http\Controllers\Faq\FaqJasaNonKonstruksi;

use App\Http\Controllers\Controller;
use App\Models\FaqJasaNonKonstruksi;

class GeneralController extends Controller
{
    /**
     * Tampilkan halaman FAQ Jasa Non-Konstruksi General.
     */
    public function index()
    {
        $faqJasaNonKonstruksis = FaqJasaNonKonstruksi::all();
        return view('faq.faq-jasa-non-konstruksi.faq-general', compact('faqJasaNonKonstruksis'));
    }
}
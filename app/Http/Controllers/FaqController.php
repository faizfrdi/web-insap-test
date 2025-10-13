<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqJasaKonstruksi;

class FaqController extends Controller
{
    /**
     * Method untuk menampilkan halaman FAQ.
     */
    public function index()
    {
        $faqGenerals = Faq::all(); // Contoh pagination: Faq::paginate(10);
        $faqJasaKonstruksis = FaqJasaKonstruksi::all();
        return view('faq.faq-general', compact('faqGenerals', 'faqJasaKonstruksis')); // Mengarahkan ke view yang benar
    }
}
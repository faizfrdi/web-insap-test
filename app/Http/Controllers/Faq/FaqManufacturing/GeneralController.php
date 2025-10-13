<?php

namespace App\Http\Controllers\Faq\FaqManufacturing;

use App\Http\Controllers\Controller;
use App\Models\FaqManufacturing;

class GeneralController extends Controller
{
    /**
     * Tampilkan halaman FAQ Manufacturing General.
     */
    public function index()
    {
        $faqManufacturings = FaqManufacturing::all();
        return view('faq.faq-manufacturing.faq-general', compact('faqManufacturings'));
    }
}
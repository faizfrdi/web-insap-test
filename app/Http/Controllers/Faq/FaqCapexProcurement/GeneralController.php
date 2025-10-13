<?php

namespace App\Http\Controllers\Faq\FaqCapexProcurement;

use App\Http\Controllers\Controller;
use App\Models\FaqCapexProcurement;

class GeneralController extends Controller
{
    /**
     * Tampilkan halaman FAQ Capex Procurement General.
     */
    public function index()
    {
        $faqCapexProcurements = FaqCapexProcurement::all();
        return view('faq.faq-capex-procurement.faq-general', compact('faqCapexProcurements'));
    }
}
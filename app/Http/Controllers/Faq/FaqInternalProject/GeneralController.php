<?php

namespace App\Http\Controllers\Faq\FaqInternalProject;

use App\Http\Controllers\Controller;
use App\Models\FaqInternalProject;

class GeneralController extends Controller
{
    /**
     * Tampilkan halaman FAQ Internal Project General.
     */
    public function index()
    {
        $faqInternalProjects = FaqInternalProject::all();
        return view('faq.faq-internal-project.faq-general', compact('faqInternalProjects'));
    }
}
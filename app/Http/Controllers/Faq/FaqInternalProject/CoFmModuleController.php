<?php

namespace App\Http\Controllers\Faq\FaqInternalProject;

use App\Http\Controllers\Controller;
use App\Models\FaqInternalProjectCoFmModule;

class CoFmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Internal Project CO/FM Module.
     */
    public function index()
    {
        $faqCoFmModules = FaqInternalProjectCoFmModule::all();
        return view('faq.faq-internal-project.faq-co-fm-module', compact('faqCoFmModules'));
    }
}
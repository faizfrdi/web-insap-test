<?php

namespace App\Http\Controllers\Faq\FaqInternalProject;

use App\Http\Controllers\Controller;
use App\Models\FaqInternalProjectMmModule;

class MmModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Internal Project MM Module.
     */
    public function index()
    {
        $faqMmModules = FaqInternalProjectMmModule::all();
        return view('faq.faq-internal-project.faq-mm-module', compact('faqMmModules'));
    }
}
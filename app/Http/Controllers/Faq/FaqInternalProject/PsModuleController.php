<?php

namespace App\Http\Controllers\Faq\FaqInternalProject;

use App\Http\Controllers\Controller;
use App\Models\FaqInternalProjectPsModule;

class PsModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Internal Project PS Module.
     */
    public function index()
    {
        $faqPsModules = FaqInternalProjectPsModule::all();
        return view('faq.faq-internal-project.faq-ps-module', compact('faqPsModules'));
    }
}
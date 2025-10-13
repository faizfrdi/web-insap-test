<?php

namespace App\Http\Controllers\Faq\FaqInternalProject;

use App\Http\Controllers\Controller;
use App\Models\FaqInternalProjectSdModule;

class SdModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Internal Project SD Module.
     */
    public function index()
    {
        $faqSdModules = FaqInternalProjectSdModule::all();
        return view('faq.faq-internal-project.faq-sd-module', compact('faqSdModules'));
    }
}
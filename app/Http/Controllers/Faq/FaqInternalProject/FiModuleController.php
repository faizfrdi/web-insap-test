<?php

namespace App\Http\Controllers\Faq\FaqInternalProject;

use App\Http\Controllers\Controller;
use App\Models\FaqInternalProjectFiModule;

class FiModuleController extends Controller
{
    /**
     * Tampilkan halaman FAQ Internal Project FI Module.
     */
    public function index()
    {
        $faqFiModules = FaqInternalProjectFiModule::all();
        return view('faq.faq-internal-project.faq-fi-module', compact('faqFiModules'));
    }
}
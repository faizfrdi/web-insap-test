<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function general()
    {
        return view('info.info-general');
    }

    public function ficoFm()
    {
        return view('info.fico-fm');
    }

    public function ps()
    {
        return view('info.ps');
    }

    public function sd()
    {
        return view('info.sd');
    }

    public function mm()
    {
        return view('info.mm');
    }
}
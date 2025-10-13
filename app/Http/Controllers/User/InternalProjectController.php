<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\InternalProject;
use Illuminate\Http\Request;

class InternalProjectController extends Controller
{
    // Fungsi untuk menampilkan halaman detail internal project berdasarkan slug
    public function showUser($slug)
    {
        $internal_project = InternalProject::where('slug', $slug)->firstOrFail();
        return view('scenarios.internal-project', compact('internal_project'));
    }
}
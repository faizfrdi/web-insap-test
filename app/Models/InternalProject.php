<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InternalProject extends Model
{
    use HasFactory;

    protected $table = 'internal_projects'; // Nama tabel di database

    protected $fillable = [
        'urutan',
        'judul',
        'input_process',
        'output_process',
        'pic',
        't_code',
        'proses',
        'link_terkait',
        'module',
        'image',
        'slug'
    ];
    
    public static function boot()
    {
        parent::boot();

        static::creating(function ($internalProject) {
            $internalProject->slug = Str::slug($internalProject->judul); // Membuat slug otomatis dari judul
        });

        static::updating(function ($internalProject) {
            $internalProject->slug = Str::slug($internalProject->judul); // Update slug jika judul berubah
        });
    }
}
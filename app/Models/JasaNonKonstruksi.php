<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JasaNonKonstruksi extends Model
{
    use HasFactory;

    protected $table = 'jasa_non_konstruksis'; // Nama tabel di database

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

        static::creating(function ($jasaNonKonstruksi) {
            $jasaNonKonstruksi->slug = Str::slug($jasaNonKonstruksi->judul); // Membuat slug otomatis dari judul
        });

        static::updating(function ($jasaNonKonstruksi) {
            $jasaNonKonstruksi->slug = Str::slug($jasaNonKonstruksi->judul); // Update slug jika judul berubah
        });
    }
}
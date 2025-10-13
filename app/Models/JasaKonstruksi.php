<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JasaKonstruksi extends Model
{
    use HasFactory;

    protected $table = 'jasa_konstruksis'; // Nama tabel di database

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

        static::creating(function ($jasaKonstruksi) {
            $jasaKonstruksi->slug = Str::slug($jasaKonstruksi->judul); // Membuat slug otomatis dari judul
        });

        static::updating(function ($jasaKonstruksi) {
            $jasaKonstruksi->slug = Str::slug($jasaKonstruksi->judul); // Update slug jika judul berubah
        });
    }
}
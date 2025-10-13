<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Manufacturing extends Model
{
    use HasFactory;

    protected $table = 'manufacturings'; // Nama tabel di database

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

        static::creating(function ($manufacturing) {
            $manufacturing->slug = Str::slug($manufacturing->judul); // Membuat slug otomatis dari judul
        });

        static::updating(function ($manufacturing) {
            $manufacturing->slug = Str::slug($manufacturing->judul); // Update slug jika judul berubah
        });
    }
}
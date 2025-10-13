<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CapexProcurement extends Model
{
    use HasFactory;

    protected $table = 'capex_procurements'; // Nama tabel di database

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

        static::creating(function ($capexProcurement) {
            $capexProcurement->slug = Str::slug($capexProcurement->judul); // Membuat slug otomatis dari judul
        });

        static::updating(function ($capexProcurement) {
            $capexProcurement->slug = Str::slug($capexProcurement->judul); // Update slug jika judul berubah
        });
    }
}
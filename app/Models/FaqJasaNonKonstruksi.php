<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqJasaNonKonstruksi extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan oleh model ini
    protected $table = 'faq_jasa_non_konstruksis';

    // Kolom yang dapat diisi (fillable) saat melakukan mass-assignment
    protected $fillable = [
        'question', // Pertanyaan FAQ
        'image',
        'answer'    // Jawaban FAQ
    ];

    // Menambahkan timestamps otomatis (created_at, updated_at) sudah aktif secara default
}

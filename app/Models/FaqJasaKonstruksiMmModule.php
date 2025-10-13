<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqJasaKonstruksiMmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_jasa_konstruksi_mm_modules';

    protected $fillable = [
        'question', 
        'image', 
        'answer',
    ];
}
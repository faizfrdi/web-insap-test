<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqJasaKonstruksiSdModule extends Model
{
    use HasFactory;

    protected $table = 'faq_jasa_konstruksi_sd_modules';

    protected $fillable = [
        'question', 
        'image', 
        'answer',
    ];
}
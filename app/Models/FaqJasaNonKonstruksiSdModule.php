<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqJasaNonKonstruksiSdModule extends Model
{
    use HasFactory;

    protected $table = 'faq_jasa_non_konstruksi_sd_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
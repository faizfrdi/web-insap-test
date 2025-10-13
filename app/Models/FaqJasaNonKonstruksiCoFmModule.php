<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqJasaNonKonstruksiCoFmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_jasa_non_konstruksi_co_fm_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqJasaKonstruksiCoFmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_jasa_konstruksi_co_fm_modules';

    protected $fillable = [
        'question', 
        'image', 
        'answer',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqJasaKonstruksiPsModule extends Model
{
    use HasFactory;

    protected $table = 'faq_jasa_konstruksi_ps_modules';

    protected $fillable = [
        'question', 
        'image', 
        'answer',
    ];
}
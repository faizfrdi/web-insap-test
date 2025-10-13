<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqManufacturingPsModule extends Model
{
    use HasFactory;

    protected $table = 'faq_manufacturing_ps_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
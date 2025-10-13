<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqManufacturingFiModule extends Model
{
    use HasFactory;

    protected $table = 'faq_manufacturing_fi_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
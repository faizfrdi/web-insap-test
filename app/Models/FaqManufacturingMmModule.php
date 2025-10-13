<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqManufacturingMmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_manufacturing_mm_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqManufacturingCoFmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_manufacturing_co_fm_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
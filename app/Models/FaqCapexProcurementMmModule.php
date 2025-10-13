<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCapexProcurementMmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_capex_procurement_mm_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCapexProcurementFiModule extends Model
{
    use HasFactory;

    protected $table = 'faq_capex_procurement_fi_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
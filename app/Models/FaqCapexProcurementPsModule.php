<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCapexProcurementPsModule extends Model
{
    use HasFactory;

    protected $table = 'faq_capex_procurement_ps_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
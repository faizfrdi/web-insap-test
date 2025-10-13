<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqInternalProjectCoFmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_internal_project_co_fm_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
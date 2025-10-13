<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqInternalProjectMmModule extends Model
{
    use HasFactory;

    protected $table = 'faq_internal_project_mm_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
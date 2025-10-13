<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqInternalProjectSdModule extends Model
{
    use HasFactory;

    protected $table = 'faq_internal_project_sd_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
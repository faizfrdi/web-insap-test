<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqInternalProjectPsModule extends Model
{
    use HasFactory;

    protected $table = 'faq_internal_project_ps_modules';

    protected $fillable = [
        'question',
        'image',
        'answer',
    ];
}
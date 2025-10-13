<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mm extends Model
{
    protected $fillable = ['report', 'status', 'description', 'link', 'image', 'file'];
}
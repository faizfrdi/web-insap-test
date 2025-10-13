<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ps extends Model
{   
    protected $table = 'pss';

    protected $fillable = ['report', 'status', 'description', 'link', 'image', 'file'];
}
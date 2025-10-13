<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    // Menambahkan relasi ke User model
    protected $fillable = [
        'session_id',
        'user_message',
        'bot_response',
        'session_title',
    ];

    // Relasi dengan User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Kolom timestamp sudah otomatis di handle oleh Laravel
    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
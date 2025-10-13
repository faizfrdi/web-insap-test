<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari 'posts'
    protected $table = 'posts';

    // Tentukan kolom yang boleh diisi
    protected $fillable = ['title', 'content', 'author_id'];

    // Jika tabel tidak memiliki kolom created_at dan updated_at, tambahkan ini
    public $timestamps = true;

    // Definisikan relasi jika ada (misalnya Post memiliki author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

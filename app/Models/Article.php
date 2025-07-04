<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika nama model tidak sesuai konvensi (plural dari Article adalah articles, tapi tabel Anda 'news')
    protected $table = 'news';

    // Definisikan kolom yang bisa diisi secara massal (jika nanti ada operasi create/update melalui model)
    protected $fillable = [
        'title',
        'content',
        'category',
        'nama_author', // Pastikan sesuai dengan nama kolom di DB
        'image',
        'created_at', // Karena Anda menginsert created_at secara manual di controller lama
    ];

    // Jika Anda tidak ingin menggunakan kolom updated_at
    public $timestamps = false; // Atau set true jika Anda mau Laravel mengelola updated_at
}
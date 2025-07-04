<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatSejarah extends Model
{
    // Nama tabel sesuai database
    protected $table = 'destinations';

    // Kolom yang bisa diisi massal (mass assignable)
    protected $fillable = [
        'name',        // varchar(255), NOT NULL
        'description', // text, NOT NULL
        'location',    // varchar(255), NOT NULL
        'category',    // varchar(255), NOT NULL
        'harga',       // decimal(10,2), NOT NULL
        'image',       // varchar(255), NULLABLE
    ];
    // Jika tabel hanya ada created_at tanpa updated_at
    const UPDATED_AT = null;
}

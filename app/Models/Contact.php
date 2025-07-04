<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts'; // Pastikan nama tabel benar

    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    public $timestamps = false; 
}
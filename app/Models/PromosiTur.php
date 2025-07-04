<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromosiTur extends Model
{
    use HasFactory;

    protected $table = 'promosi_tur';

    public $timestamps = false;  // Nonaktifkan timestamps

    protected $fillable = [
        'name', 'description', 'category', 'price', 'location', 'image'
    ];
}

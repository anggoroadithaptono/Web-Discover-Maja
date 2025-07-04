<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananPromosiTur extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_promosi_tur';

    protected $fillable = [
        'promosi_id',
        'nama_pemesanan',
        'jumlah_orang',
        'tanggal_kunjungan',
        'email',
        'total_harga',
        'metode_pembayaran'
    ];

    public $timestamps = false;

    protected $casts = [
        'tanggal_kunjungan' => 'date', // penting ini
    ];
}

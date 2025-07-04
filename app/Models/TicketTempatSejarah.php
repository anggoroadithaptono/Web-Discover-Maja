<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketTempatSejarah extends Model
{
    protected $table = 'tickets'; // Sesuaikan nama tabel jika perlu

    public $timestamps = false; // Nonaktifkan fitur timestamp Laravel

    protected $fillable = [
        'destinasi_id', 'ticket_type', 'nama_pemesanan', 'jumlah_orang',
        'visit_date', 'visit_time', 'total_harga', 'payment_method'
    ];

    public function destinasi()
    {
        return $this->belongsTo(TempatSejarah::class, 'destinasi_id');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\TicketTempatSejarah;
use App\Models\PemesananPromosiTur;

use Illuminate\Http\Request;

class PageControllerPengguna extends Controller
{
    public function homepengguna()
    {
        $contacts = Contact::all();

    // Statistik per tanggal
    $ticketSales = TicketTempatSejarah::selectRaw('visit_date as tanggal, COUNT(*) as total')
                    ->groupBy('visit_date')->orderBy('visit_date')->get();

    $promosiSales = PemesananPromosiTur::selectRaw('tanggal_kunjungan as tanggal, COUNT(*) as total')
                    ->groupBy('tanggal_kunjungan')->orderBy('tanggal_kunjungan')->get();

    // Total pemasukan
    $totalUangTiket = TicketTempatSejarah::sum('total_harga');
    $totalUangPromo = PemesananPromosiTur::sum('total_harga');

    return view('discover-maja-user.homepengguna', [
        'contacts' => $contacts,
        'ticketData' => $ticketSales,
        'promosiData' => $promosiSales,
        'totalUangTiket' => $totalUangTiket,
        'totalUangPromo' => $totalUangPromo,
    ]);
    }
}

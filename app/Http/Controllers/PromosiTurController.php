<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromosiTur;
use Illuminate\Support\Facades\Storage;
use App\Models\PemesananPromosiTur; // Model untuk tabel pemesanan_promosi_tur

class PromosiTurController extends Controller
{
    // Menampilkan halaman promosi tur dengan filter kategori dan pencarian
    public function index(Request $request)
    {
        // Ambil semua kategori untuk filter
        $kategori_result = PromosiTur::select('category')->distinct()->get();

        // Tangkap filter kategori dan pencarian
        $filter_category = $request->get('category', 'Semua');
        $search_keyword = $request->get('search', '');

        // Query berdasarkan filter dan pencarian
        $query = PromosiTur::query();
        
        if ($filter_category !== 'Semua') {
            $query->where('category', $filter_category);
        }

        if ($search_keyword) {
            $query->where(function($q) use ($search_keyword) {
                $q->where('name', 'like', '%' . $search_keyword . '%')
                  ->orWhere('description', 'like', '%' . $search_keyword . '%')
                  ->orWhere('category', 'like', '%' . $search_keyword . '%')
                  ->orWhere('location', 'like', '%' . $search_keyword . '%')
                  ->orWhereRaw('CAST(price AS CHAR) LIKE ?', ['%' . $search_keyword . '%']);
            });
        }

        $promosi_tur = $query->get();

        return view('discover-maja.PromosiTur.homepromositur', compact('kategori_result', 'filter_category', 'search_keyword', 'promosi_tur'));
    }

    // Method untuk menghapus promosi
    public function hapusPromosi($id)
    {
        // Cari promosi berdasarkan ID
        $promosi = PromosiTur::find($id);

        // Jika promosi ditemukan, hapus
        if ($promosi) {
            $promosi->delete();
            return redirect()->route('homepromositur.index')->with('success', 'Promosi berhasil dihapus!');
        } else {
            return redirect()->route('homepromositur.index')->with('error', 'Promosi tidak ditemukan!');
        }
    }


    // Menampilkan detail promosi tur berdasarkan ID
    public function detail($id)
    {
        // Ambil data promosi berdasarkan ID
        $promo = PromosiTur::find($id);

        if (!$promo) {
            return redirect()->route('homepromositur.index')->with('error', 'Promosi tidak ditemukan!');
        }

        return view('discover-maja.PromosiTur.detail_promositur', compact('promo'));
    }

    // Menampilkan halaman pesan promosi tur berdasarkan ID
    public function pesan($id)
    {
        // Ambil data promosi berdasarkan ID
        $promo = PromosiTur::find($id);

        if (!$promo) {
            return redirect()->route('homepromositur.index')->with('error', 'Promosi tidak ditemukan!');
        }

        // Lakukan proses pemesanan (misalnya, tampilkan form pemesanan)
        return view('discover-maja.PromosiTur.pesan_promositur', compact('promo'));
    }

 // Tampilkan form edit promosi tur
    public function edit($id)
    {
        $promo = PromosiTur::find($id);

        if (!$promo) {
            return redirect()->route('homepromositur.index')->with('error', 'Promosi tidak ditemukan!');
        }

        return view('discover-maja.PromosiTur.edit_promositur', compact('promo'));
    }

    // Proses update promosi tur
    public function update(Request $request, $id)
    {
        $promo = PromosiTur::find($id);

        if (!$promo) {
            return redirect()->route('homepromositur.index')->with('error', 'Promosi tidak ditemukan!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image_name = $promo->image; // Default gambar lama
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Simpan gambar baru di folder public/uploads
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $image_name);
        }

        // Update data promosi tur
        $promo->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'location' => $request->location,
            'image' => $image_name,
        ]);

        return redirect()->route('homepromositur.index')->with('success', 'Promosi berhasil diperbarui!');
    }

   // Tampilkan form tambah promosi tur
    public function create()
    {
        return view('discover-maja.PromosiTur.tambah_promositur');
    }

    // Simpan data promosi tur baru
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image_name = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Simpan gambar di folder public/uploads
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $image_name);
        }

        // Simpan data ke database
        PromosiTur::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'location' => $request->location,
            'image' => $image_name,
        ]);

        return redirect()->route('homepromositur.index')->with('success', 'Promosi berhasil ditambahkan!');
    }
    
     // Menampilkan form pemesanan promosi tur
    public function showPesanForm($id)
    {
        $promo = PromosiTur::find($id);
        if (!$promo) {
            return redirect()->route('homepromositur.index')->with('error', 'Promosi tidak ditemukan!');
        }

        return view('discover-maja.PromosiTur.pesan_promositur', compact('promo'));
    }

    // Menangani submit form pemesanan
    public function submitPesan(Request $request, $id)
{
    $promo = PromosiTur::find($id);
    if (!$promo) {
        return redirect()->route('homepromositur.index')->with('error', 'Promosi tidak ditemukan!');
    }

    $request->validate([
        'nama_pemesanan' => 'required|string|max:255',
        'jumlah_orang' => 'required|integer|min:1',
        'tanggal_kunjungan' => 'required|date',
        'email' => 'required|email|max:255',
        'metode_pembayaran' => 'required|string|max:50',
    ]);

    $total_harga = $promo->price * $request->jumlah_orang;

    $pemesanan = PemesananPromosiTur::create([
        'promosi_id' => $promo->id,
        'nama_pemesanan' => $request->nama_pemesanan,
        'jumlah_orang' => $request->jumlah_orang,
        'tanggal_kunjungan' => $request->tanggal_kunjungan,
        'email' => $request->email,
        'total_harga' => $total_harga,
        'metode_pembayaran' => $request->metode_pembayaran,
    ]);

    // Redirect ke halaman struk dengan id pemesanan
    return redirect()->route('promosi-tur.struk', ['id' => $pemesanan->id])
                     ->with('success', 'Pemesanan berhasil! Total Harga: Rp ' . number_format($total_harga, 0, ',', '.'));
}


    public function lihatPembelian()
    {
        // Mengambil semua data pemesanan, urut terbaru
        $pembelian = PemesananPromosiTur::orderBy('created_at', 'desc')->get();

        // Kirim data ke view
        return view('discover-maja.PromosiTur.lihatpembelian_promositur', compact('pembelian'));
    }


    public function strukPemesanan($id)
{
    $pemesanan = PemesananPromosiTur::find($id);
    if (!$pemesanan) {
        return redirect()->route('homepromositur.index')->with('error', 'Pemesanan tidak ditemukan!');
    }
    return view('discover-maja.PromosiTur.strukpemesanan_promositur', compact('pemesanan'));
}

// Tampilkan daftar promosi untuk pengguna
public function indexUser(Request $request)
{
    $filter_category = $request->input('category', 'Semua');
    $search_keyword = $request->input('search', '');

    $query = \App\Models\PromosiTur::query();

    if ($filter_category !== 'Semua') {
        $query->where('category', $filter_category);
    }

    if (!empty($search_keyword)) {
        $query->where(function ($q) use ($search_keyword) {
            $q->where('name', 'like', '%' . $search_keyword . '%')
              ->orWhere('location', 'like', '%' . $search_keyword . '%')
              ->orWhere('description', 'like', '%' . $search_keyword . '%');
        });
    }

    $promosi_tur = $query->latest()->get();
    $kategori_result = \App\Models\PromosiTur::select('category')->distinct()->get();

    return view('discover-maja-user.PromosiTur.homepromosituruser', compact(
        'promosi_tur', 'filter_category', 'search_keyword', 'kategori_result'
    ));
}

// Tampilkan detail promosi untuk pengguna
public function showUser($id)
{
    $promo = PromosiTur::findOrFail($id);
    return view('discover-maja-user.PromosiTur.detail_promosituruser', compact('promo'));
}

}

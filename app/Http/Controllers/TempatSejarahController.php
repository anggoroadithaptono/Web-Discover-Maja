<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatSejarah;
use Illuminate\Support\Str;
use App\Models\TicketTempatSejarah; // Pastikan ini ada jika digunakan untuk tiket

class TempatSejarahController extends Controller
{


     public function index(Request $request)
    {
        // Tidak perlu lagi query data di sini, karena Livewire HomeArticle akan melakukannya
        return view('discover-maja.TempatSejarah.TempatSejarah');
    }


    // Hapus atau komentari metode destroy() ini karena sudah digantikan oleh Livewire
    // Aktifkan kembali metode destroy() ini untuk menangani penghapusan
    public function destroy($id)
    {
        $tempat = TempatSejarah::find($id); // Lebih baik gunakan Eloquent
        if ($tempat) {
            // Hapus file gambar jika ada (opsional)
            if ($tempat->image && file_exists(public_path('uploads/' . $tempat->image))) {
                unlink(public_path('uploads/' . $tempat->image));
            }
            $tempat->delete(); // Menghapus data menggunakan Eloquent

            // Anda ingin redirect ke index tempat sejarah, bukan artikel
            return redirect()->route('tempatsejarah.index')->with('success', 'Tempat Sejarah berhasil dihapus!');
        }

        // Jika tidak ditemukan, bisa redirect dengan error atau 404
        return redirect()->route('tempatsejarah.index')->with('error', 'Tempat Sejarah tidak ditemukan.');
    }

    // Method untuk menampilkan detail destinasi (TETAP ADA)
    public function show($id)
    {
        $tempatSejarah = TempatSejarah::findOrFail($id);
        return view('discover-maja.TempatSejarah.detailtempatsejarah', compact('tempatSejarah'));
    }

    public function tempatSejarahUser()
{
    return view('discover-maja-user.TempatSejarah.TempatSejarahUser');
}

public function showUser($id)
{
    $tempatSejarah = TempatSejarah::findOrFail($id);
    return view('discover-maja-user.TempatSejarah.detailtempatsejarahuser', compact('tempatSejarah'));
}


    // Method untuk menampilkan form tambah destinasi (TETAP ADA)
    public function create()
    {
        return view('discover-maja.TempatSejarah.tambahtempatsejarah');
    }

    // Method untuk menyimpan data destinasi baru (TETAP ADA)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $imageName);
        }

        TempatSejarah::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'category' => $request->category,
            'harga' => $request->harga,
            'image' => $imageName,
        ]);

        return redirect()->route('tempatsejarah.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    // Menampilkan form edit (TETAP ADA)
    public function edit($id)
    {
        $tempatSejarah = TempatSejarah::findOrFail($id);
        return view('discover-maja.TempatSejarah.edittempatsejarah', compact('tempatSejarah'));
    }

    // Memproses update data (TETAP ADA)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tempatSejarah = TempatSejarah::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $tempatSejarah->image = $filename;
        }

        $tempatSejarah->name = $request->name;
        $tempatSejarah->description = $request->description;
        $tempatSejarah->location = $request->location;
        $tempatSejarah->category = $request->category;
        $tempatSejarah->save();

        return redirect()->route('tempatsejarah.show', $tempatSejarah->id)
                         ->with('success', 'Destinasi berhasil diperbarui!');
    }

    // Menampilkan form pembelian tiket berdasarkan destinasi (TETAP ADA)
    public function showForm($id)
    {
        $destinasi = TempatSejarah::find($id);

        if (!$destinasi) {
            abort(404, 'Destinasi tidak ditemukan');
        }

        return view('discover-maja.TempatSejarah.belitikettempatsejarah', compact('destinasi'));
    }

    // Proses penyimpanan data pembelian tiket (TETAP ADA)
    public function processForm(Request $request)
    {
        $request->validate([
            'destinasi_id' => 'required|exists:destinations,id', // <<< PASTIKAN 'tempat_sejarah' SESUAI NAMA TABEL ANDA
            'ticket_type' => 'required|string',
            'nama_pemesanan' => 'required|string|max:255',
            'jumlah_orang' => 'required|integer|min:1',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'payment_method' => 'required|string',
        ]);

        $destinasi = TempatSejarah::find($request->destinasi_id);
        if (!$destinasi) {
            return back()->withErrors(['destinasi_id' => 'Destinasi tidak ditemukan']);
        }

        $total_harga = $destinasi->harga * $request->jumlah_orang;

        $ticket = TicketTempatSejarah::create([
            'destinasi_id' => $request->destinasi_id,
            'ticket_type' => $request->ticket_type,
            'nama_pemesanan' => $request->nama_pemesanan,
            'jumlah_orang' => $request->jumlah_orang,
            'visit_date' => $request->visit_date,
            'visit_time' => $request->visit_time,
            'total_harga' => $total_harga,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('belitiket.cetak', ['id' => $ticket->id]);
    }

    // Tampilkan halaman cetak tiket (TETAP ADA)
    public function cetakTiket($id)
    {
        $ticket = TicketTempatSejarah::with('destinasi')->findOrFail($id);
        return view('discover-maja.TempatSejarah.cetaktikettempatsejarah', compact('ticket'));
    }

    // Tampilkan halaman lihat penjualan tiket (TETAP ADA)
    public function lihatPenjualanTiket()
    {
        $tickets = TicketTempatSejarah::with('destinasi')->get();
        return view('discover-maja.TempatSejarah.lihatpenjualantiket_tempatsejarah', compact('tickets'));
    }
}
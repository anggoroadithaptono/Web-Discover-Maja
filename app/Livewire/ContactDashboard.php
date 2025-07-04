<?php

namespace App\Livewire;

use App\Models\Contact; // Pastikan model Contact di-import
use Livewire\Component;
use Illuminate\Support\Facades\DB; // Pastikan ini di-import

class ContactDashboard extends Component
{
    // Properti publik apa pun di sini akan tersedia untuk view Livewire
    // public $search = ''; // Contoh: jika Anda ingin menambahkan fitur pencarian interaktif

    public function render()
    {
        // Logika pengambilan data kontak untuk tabel
        $contacts = Contact::all(); // <-- Jika ingin pagination, ubah ke Contact::paginate(jumlah)

        // Logika pengambilan data untuk grafik (menghitung status kontak)
        $contactStatusData = Contact::select('status', DB::raw('count(*) as total'))
                                     ->groupBy('status')
                                     ->pluck('total', 'status') // Mengambil total sebagai value, status sebagai key
                                     ->toArray(); // Mengubahnya menjadi array PHP

        // Mengembalikan view Blade komponen Livewire ini dan meneruskan data
        return view('livewire.contact-dashboard', [
            'contacts' => $contacts,
            'contactStatusData' => $contactStatusData,
        ]);
    }

    // Metode Livewire yang dipanggil saat status kontak diubah dari frontend
    public function updateContactStatus($contactId, $newStatus)
    {
        // Validasi status yang diizinkan untuk mencegah input yang tidak valid
        $allowedStatuses = ['new', 'pending', 'resolved', 'closed'];
        if (!in_array($newStatus, $allowedStatuses)) {
            // Jika status tidak valid, tampilkan pesan error
            session()->flash('error', 'Status tidak valid.');
            return;
        }

        // Cari kontak berdasarkan ID
        $contact = Contact::findOrFail($contactId);
        // Perbarui status kontak
        $contact->status = $newStatus;
        // Simpan perubahan ke database
        $contact->save();

        // Tampilkan pesan sukses (akan muncul di bagian atas komponen Livewire)
        session()->flash('message', 'Status kontak berhasil diperbarui!');

        // PENTING: Pancarkan (dispatch) event kustom ke JavaScript
        // Ini memberitahu JavaScript di view untuk menggambar ulang grafik dengan data terbaru.
        // Kita perlu menghitung ulang data untuk grafik karena status sudah berubah.
        $updatedContactStatusData = Contact::select('status', DB::raw('count(*) as total'))
                                             ->groupBy('status')
                                             ->pluck('total', 'status')
                                             ->toArray();
        $this->dispatch('chartUpdated', $updatedContactStatusData); // Mengirimkan event dan data baru ke frontend
    }
}
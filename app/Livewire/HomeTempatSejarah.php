<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TempatSejarah; // Pastikan model ini diimpor dengan benar
use Livewire\WithPagination; // Untuk fungsionalitas pagination

class HomeTempatSejarah extends Component // <<< Nama kelas diubah
{
    use WithPagination; // Mengaktifkan pagination di Livewire

    // Properti publik yang akan terikat dengan input HTML di view
    public $search = '';
    public $filter_category = 'all';

    // Metode ini otomatis dipanggil Livewire saat properti $search berubah
    // Tujuannya untuk mereset halaman pagination ke-1 saat pencarian baru dilakukan
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Metode ini otomatis dipanggil Livewire saat properti $filter_category berubah
    // Tujuannya untuk mereset halaman pagination ke-1 saat filter baru dipilih
    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    

    // Metode render() adalah tempat utama untuk mengambil data dan menampilkan view
    // Metode ini akan otomatis dipanggil Livewire setiap kali ada perubahan data/properti
    public function render()
    {
        $query = TempatSejarah::query(); // Memulai query untuk model TempatSejarah

        // Terapkan filter kategori jika $filter_category bukan 'all'
        if ($this->filter_category !== 'all') {
            $query->where('category', $this->filter_category);
        }

        // Terapkan pencarian jika ada kata kunci di $search
        if ($this->search) {
            $query->where(function($q) {
                // Cari di kolom 'name', 'description', 'location', dan 'category'
                // Menggunakan 'like' untuk pencarian parsial (case-insensitive)
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
            });
        }

        // Ambil data tempat sejarah dengan pagination (misalnya 9 item per halaman)
        $tempatSejarahList = $query->paginate(9);

        // Ambil semua kategori unik dari tabel 'tempat_sejarah' untuk dropdown filter
        $categories = TempatSejarah::select('category')->distinct()->get();

        // Mengembalikan view komponen Livewire bersama dengan data yang diperlukan
        return view('livewire.home-tempat-sejarah', [ // <<< Nama view diubah
            'tempatSejarahList' => $tempatSejarahList,
            'categories' => $categories,
        ]);
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article; // Pastikan mengimpor Model Article yang baru dibuat
use Livewire\WithPagination; // Penting untuk pagination

class HomeArticle extends Component
{
    use WithPagination;

    // Properti publik yang akan terikat dengan input HTML
    public $search = '';
    public $filter_category = 'all';

    // Metode ini akan otomatis dipanggil Livewire saat properti $search berubah
    public function updatingSearch()
    {
        $this->resetPage(); // Reset halaman pagination ke-1 saat pencarian berubah
    }

    // Metode ini akan otomatis dipanggil Livewire saat properti $filter_category berubah
    public function updatingFilterCategory()
    {
        $this->resetPage(); // Reset halaman pagination ke-1 saat filter berubah
    }

    

    // Metode render() adalah tempat utama untuk mengambil data dan menampilkan view
    public function render()
    {
        $query = Article::query();

        // Terapkan filter kategori jika bukan 'all'
        if ($this->filter_category !== 'all') {
            $query->where('category', $this->filter_category);
        }

        // Terapkan pencarian jika ada kata kunci
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%') // Pencarian juga di kolom kategori
                  ->orWhere('nama_author', 'like', '%' . $this->search . '%'); // Pencarian juga di kolom nama_author
            });
        }

        // Ambil artikel dengan pagination
        $articles = $query->paginate(10); // Menampilkan 10 artikel per halaman (Anda bisa sesuaikan)

        // Ambil semua kategori unik untuk dropdown filter dari tabel 'news'
        $categories = Article::select('category')->distinct()->get();


        return view('livewire.home-article', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
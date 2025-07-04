<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Livewire\WithPagination;

class HomeArticleUser extends Component
{
    use WithPagination;

    public $search = '';
    public $filter_category = 'all';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Article::query();

        // Filter kategori jika bukan 'all'
        if ($this->filter_category !== 'all') {
            $query->where('category', $this->filter_category);
        }

        // Pencarian kata kunci di beberapa kolom
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%')
                  ->orWhere('nama_author', 'like', '%' . $this->search . '%');
            });
        }

        // Pagination
        $articles = $query->latest()->paginate(9); // tampilkan 9 artikel per halaman

        // Ambil kategori unik untuk filter
        $categories = Article::select('category')->distinct()->get();

        return view('livewire.home-article-user', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}

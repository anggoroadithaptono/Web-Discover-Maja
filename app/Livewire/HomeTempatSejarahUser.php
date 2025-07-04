<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TempatSejarah;
use Livewire\WithPagination;

class HomeTempatSejarahUser extends Component
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
        $query = TempatSejarah::query();

        if ($this->filter_category !== 'all') {
            $query->where('category', $this->filter_category);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        $tempatSejarahList = $query->latest()->paginate(9);

        $categories = TempatSejarah::select('category')->distinct()->get();

        return view('livewire.home-tempat-sejarah-user', [
            'tempatSejarahList' => $tempatSejarahList,
            'categories' => $categories,
        ]);
    }
}

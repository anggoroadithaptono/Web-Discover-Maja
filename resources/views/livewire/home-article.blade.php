<div class="main-article-wrapper"> {{-- Ini adalah satu-satunya root element --}}

    <div class="filter-container">
        <div class="filter-bar">
            <label for="filter">Filter Kategori:&nbsp;</label>
            <select id="filter" wire:model.live="filter_category">
                <option value="all">Semua</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}">
                        {{ ucfirst($category->category) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="add-article-btn" onclick="window.location.href='{{ route('artikel.create') }}'">Tambah Artikel</button>

        <div class="search-form">
            <input type="text" wire:model.live="search" placeholder="Cari artikel..." />
        </div>
    </div>

    <div class="filter-title">
        Artikel Bersejarah
    </div>

    <div wire:loading style="text-align: center; margin-top: 10px; font-style: italic; color: gray;">
        <p>Memuat artikel...</p>
    </div>

    <div class="container" id="tempat-list">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('message') }}
            </div>
        @endif

        @if ($articles->isEmpty())
            <p class="no-article-message">Tidak ada artikel yang ditemukan.</p>
        @else
            @foreach ($articles as $article)
                <div class="place-card" data-category="{{ strtolower($article->category) }}">
                    <h3 class="place-title">{{ $article->title }}</h3>
                    <div class="place-image-wrapper">
                        <img src="{{ asset('uploads/' . rawurlencode($article->image)) }}" alt="Gambar Artikel {{ $article->title }}" class="place-image" />
                    </div>
                    <p class="place-description">{{ \Illuminate\Support\Str::limit($article->content, 150, '...') }}</p>
                    <div class="article-actions">
                        <a href="{{ route('artikel.show', $article->id) }}" class="detail-link">Detail</a>
                        {{-- Tombol hapus sekarang menjadi form HTML --}}
                    <form action="{{ route('artikel.delete', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                        @csrf
                        @method('DELETE') {{-- PENTING: Untuk mengirimkan permintaan DELETE --}}
                        <button type="submit" class="delete-button">Hapus</button>
                    </form>
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>

</div> {{-- Penutup div root element --}}
<div class="w-full bg-white px-4 py-8 rounded-md shadow-md">

    <div class="main-article-wrapper"> {{-- Sama seperti admin --}}

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

            {{-- TANPA tombol Tambah Artikel --}}
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
<a href="{{ route('artikel.user.show', $article->id) }}" class="detail-link">Detail</a>

                            {{-- TANPA tombol Hapus --}}
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        </div>

    </div> {{-- Penutup main-article-wrapper --}}

</div> {{-- Penutup bg-white container --}}

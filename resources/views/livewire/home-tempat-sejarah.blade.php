{{-- PASTIKAN SEMUA KONTEN DI DALAM SATU DIV ROOT INI --}}
<div class="main-tempat-sejarah-wrapper">

    <div class="filter-buttons">
        <div class="dropdown">
            <label for="category-filter">Filter Kategori:&nbsp;</label>
            <select id="category-filter" wire:model.live="filter_category">
                <option value="all">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}">
                        {{ ucfirst($category->category) }}
                    </option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('penjualan.tiket') }}" class="button destinasi-button">Lihat Pembelian</a>
        <a href="{{ route('tempatsejarah.create') }}" class="button destinasi-button">Tambah Tempat Sejarah</a>
    </div>

    <div class="search-form" style="text-align:center; margin:20px 0;">
        <input type="text" wire:model.live="search" placeholder="Cari destinasi..." />
    </div>

    <div class="section-title">Tempat Bersejarah</div>

    <div wire:loading style="text-align: center; margin-top: 10px; font-style: italic; color: gray;">
        <p>Memuat tempat sejarah...</p>
    </div>

    <div class="container" id="tempat-list">
        {{-- Menampilkan pesan sukses dari session (setelah hapus/tambah/update) --}}
        @if (session()->has('message'))
            {{-- Tambahkan ID untuk memudahkan JS --}}
            <div id="notification-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('message') }}
            </div>
        @endif

        {{-- Cek apakah ada destinasi yang ditemukan --}}
        @if ($tempatSejarahList->count() > 0)
            @foreach ($tempatSejarahList as $tempat)
                <div class="place-card" data-category="{{ strtolower($tempat->category) }}">
                    <img src="{{ asset('uploads/' . $tempat->image) }}" alt="Gambar Destinasi" class="place-image">
                    <h3>{{ $tempat->name }}</h3>
                    <a href="{{ route('tempatsejarah.show', $tempat->id) }}">Lihat Detail</a>
                    <a href="{{ route('belitiket.form', ['id' => $tempat->id]) }}" class="buy-ticket-button">Beli Tiket</a>

                    {{-- Tombol hapus Livewire --}}
                    <form action="{{ route('tempatsejarah.destroy', $tempat->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE') {{-- Penting untuk metode DELETE --}}
                        <button type="submit" class="delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?');">Hapus</button>
                    </form>
                   
                </div>
            @endforeach
        @else
            <p style="text-align:center;">Tidak ada destinasi yang ditemukan.</p>
        @endif
    </div>

    {{-- Pagination Links Livewire --}}
    <div class="mt-4">
        {{ $tempatSejarahList->links() }}
    </div>

    {{-- Script untuk menyembunyikan notifikasi setelah beberapa detik --}}
    {{-- Menggunakan @script untuk Livewire v3 atau lebih tinggi --}}
    @script
    <script>
        document.addEventListener('livewire:navigated', () => { // Gunakan livewire:navigated untuk Livewire v3+
            const notification = document.getElementById('notification-message');
            if (notification) {
                setTimeout(() => {
                    notification.style.transition = 'opacity 0.5s ease-out';
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 500); // Hapus elemen setelah transisi selesai
                }, 3000); // Notifikasi akan hilang setelah 3 detik (3000 ms)
            }
        });
    </script>
    @endscript

</div> {{-- Penutup dari satu-satunya root element --}}
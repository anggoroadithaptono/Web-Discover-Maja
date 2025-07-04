<div class="main-tempat-sejarah-wrapper px-4 md:px-12 lg:px-20 py-10 bg-[#f2f2f2]">

    {{-- Filter & Search --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div class="flex items-center gap-2">
            <label for="category-filter" class="font-medium text-[#3e2f1c]">Filter Kategori:</label>
            <select id="category-filter" wire:model.live="filter_category" class="border px-3 py-2 rounded shadow-sm text-sm">
                <option value="all">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}">{{ ucfirst($category->category) }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-1/3">
            <input type="text" wire:model.live="search" placeholder="Cari destinasi..." 
                   class="w-full border px-4 py-2 rounded shadow-sm text-sm" />
        </div>
    </div>

    {{-- Judul --}}
    <h2 class="text-2xl md:text-3xl font-bold text-center text-[#3e2f1c] mb-6">Tempat Bersejarah</h2>

    {{-- Loading --}}
    <div wire:loading class="text-center text-sm italic text-gray-500 mb-4">
        Memuat tempat sejarah...
    </div>

    {{-- List Tempat --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($tempatSejarahList as $tempat)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-[1.02] duration-200">
            <img src="{{ asset('uploads/' . $tempat->image) }}" alt="Gambar {{ $tempat->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-center text-[#3e2f1c] mb-2">{{ $tempat->name }}</h3>

                {{-- Deskripsi singkat (dibatasi 100 karakter) --}}
                <p class="text-sm text-gray-600 text-justify mb-4">
                    {{ \Illuminate\Support\Str::limit(strip_tags($tempat->description), 100, '...') }}
                </p>

                <div class="flex justify-center gap-3">
    <a href="{{ route('tempatsejarah.user.show', $tempat->id) }}"
       class="bg-[#a65c2a] text-white px-4 py-2 rounded text-sm hover:bg-[#934b21] transition">
        Lihat Detail
    </a>
    <a href="{{ route('belitiket.form', ['id' => $tempat->id]) }}"
       class="bg-[#3e2f1c] text-white px-4 py-2 rounded text-sm hover:bg-[#2d2215] transition">
        Beli Tiket
    </a>
</div>

            </div>
        </div>
    @empty
        <p class="text-center text-gray-500 col-span-full">Tidak ada destinasi yang ditemukan.</p>
    @endforelse
</div>


    {{-- Pagination --}}
    <div class="mt-6">
        {{ $tempatSejarahList->links() }}
    </div>
</div>

@extends('layouts.app')

{{-- Pastikan path CSS sudah benar --}}
<link rel="stylesheet" href="{{ asset('css/TempatSejarah/TempatSejarah.css') }}">

@section('content')
<div class="header-wrapper">
  <header>
    <div class="logo-container">
      <img src="{{ asset('images/lambangawal.png') }}" alt="logo" class="logo-img">
      <h1 class="logo-title">Discover Maja</h1>
    </div>

    <div class="hamburger" id="hamburger">
      <span class="hamburger-icon">&#9776;</span>
    </div>

    <div class="nav-menu" id="nav-menu">
      <ul>
        <li class="center-menu"><a href="{{ url('/') }}">Beranda</a></li>
        <li class="center-menu"><a href="{{ route('artikel.index') }}">Artikel Bersejarah</a></li>
        <li class="center-menu"><a href="{{ route('tempatsejarah.index') }}" class="active">Tempat Bersejarah</a></li>
        <li class="center-menu"><a href="{{ route('homepromositur.index') }}">Paket Tur</a></li>
      </ul>

      <div class="header-right">
        <div class="auth-buttons">
          <a href="{{ url('login') }}" class="button">Sign In</a>
          <a href="{{ url('register') }}" class="button">Sign Up</a>
        </div>
        <div class="language-selector">
          <select id="language-selector" onchange="changeLanguage()">
            <option value="id" {{ request('lang') == 'id' ? 'selected' : '' }}>Indonesia (ID)</option>
            <option value="en" {{ request('lang') == 'en' ? 'selected' : '' }}>English (EN)</option>
            <option value="jv" {{ request('lang') == 'jv' ? 'selected' : '' }}>Jawa (JV)</option>
          </select>
        </div>
      </div>
    </div>
  </header>
</div>

{{-- PENTING: Panggil komponen Livewire dengan nama BARU di sini --}}
{{-- Ini akan me-render konten dari resources/views/livewire/home-tempat-sejarah.blade.php --}}
<livewire:home-tempat-sejarah /> {{-- <<< Nama komponen diubah --}}

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
// Fungsi JavaScript lama untuk filterTempat() tidak diperlukan lagi karena Livewire menanganinya.
// Anda bisa menghapusnya sepenuhnya atau mengomentarinya.
/*
function filterTempat() {
  const filterValue = document.getElementById('category-filter').value;
  const searchInput = document.querySelector('input[name="search"]');
  const searchValue = searchInput ? searchInput.value : '';

  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set('category', filterValue);
  if (searchValue) {
    urlParams.set('search', searchValue);
  } else {
    urlParams.delete('search');
  }
  window.location.href = "{{ route('tempatsejarah.index') }}?" + urlParams.toString();
}
*/

// Ini tetap ada jika Anda menggunakannya untuk navigasi mobile
document.getElementById("hamburger").onclick = function () {
  var menu = document.getElementById("nav-menu");
  menu.classList.toggle("active");
};

// Fungsi changeLanguage() jika masih diperlukan dan implementasinya ada di tempat lain
function changeLanguage() {
    console.log('Language changed to: ', document.getElementById('language-selector').value);
    // Implementasi logika perubahan bahasa di sini
}
</script>
@endsection
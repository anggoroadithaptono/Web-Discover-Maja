@extends('layouts.app')

{{-- Path CSS yang sama dapat digunakan jika tampilannya tetap --}}
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
              <li class="center-menu"><a href="{{ route('artikel.user') }}">Artikel Bersejarah</a></li>
              <li class="center-menu"><a href="{{ route('tempatsejarah.user.index') }}" class="active">Tempat Bersejarah</a></li>
              <li class="center-menu"><a href="{{ route('homepromositur.user.index') }}">Paket Tur</a></li>
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

{{-- Komponen Livewire khusus user tanpa hak akses edit/hapus/tambah --}}
<livewire:home-tempat-sejarah-user />

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
document.getElementById("hamburger").onclick = function () {
  var menu = document.getElementById("nav-menu");
  menu.classList.toggle("active");
};

function changeLanguage() {
  console.log('Language changed to: ', document.getElementById('language-selector').value);
  // Anda bisa integrasikan dengan route locale switcher jika ada
}
</script>
@endsection

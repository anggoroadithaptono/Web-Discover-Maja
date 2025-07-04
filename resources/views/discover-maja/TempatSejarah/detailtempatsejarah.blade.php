@extends('layouts.app')

@section('title', $tempatSejarah->name . ' - Discover Maja')

<link rel="stylesheet" href="{{ asset('css/TempatSejarah/detail_tempatsejarah.css') }}">

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
          <a href="{{ url('signup') }}" class="button">Sign Up</a>
        </div>

        <div class="language-selector">
          <select id="language-selector" onchange="changeLanguage()">
            <option value="id">Indonesia (ID)</option>
            <option value="en">English (EN)</option>
            <option value="jv">Jawa (JV)</option>
          </select>
        </div>
      </div>
    </div>
  </header>
</div>

<main>
  <div class="detail-container">
    <img src="{{ asset('uploads/' . $tempatSejarah->image) }}" alt="Gambar Destinasi" class="destination-image"><br><br>

    <h2>{{ $tempatSejarah->name }}</h2>
    <p><strong>Kategori:</strong> {{ $tempatSejarah->category }}</p>
    <p><strong>Deskripsi:</strong> {!! nl2br(e($tempatSejarah->description)) !!}</p>
    <p><strong>Lokasi:</strong> {{ $tempatSejarah->location }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($tempatSejarah->harga, 2, ',', '.') }}</p>
    <p><strong>Dibuat pada:</strong> {{ $tempatSejarah->created_at->format('d-m-Y H:i') }}</p>

    <a href="{{ route('tempatsejarah.index') }}" class="back-button">Kembali</a>
    <a href="{{ route('tempatsejarah.edit', $tempatSejarah->id) }}" class="edit-button">Edit Destinasi</a>
  </div>
</main>

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
  document.getElementById("hamburger").onclick = function () {
    var menu = document.getElementById("nav-menu");
    menu.classList.toggle("active"); // Toggle class active untuk menampilkan/menyembunyikan menu
  };
</script>
@endsection

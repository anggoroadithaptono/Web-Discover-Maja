@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/TempatSejarah/tambahtempatsejarah.css') }}">

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
              <li class="center-menu"><a href="index.php">Beranda</a></li>
              <li class="center-menu"><a href="ArtikelSejarah.php">Artikel Bersejarah</a></li>
              <li class="center-menu"><a href="#" onclick="window.location.reload();" class="active">Tempat Bersejarah</a></li>
              <li class="center-menu"><a href="{{ route('homepromositur.index') }}">Paket Tur</a></li>
              </ul>

              <div class="header-right">
                <div class="auth-buttons">
                  <a href="login.html" class="button">Sign In</a>
                  <a href="signup.html" class="button">Sign Up</a>
                </div>
                
                <!-- Pindahkan language-selector setelah Sign Up -->
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

<div class="container">
    <h2>Tambah Destinasi</h2>

    {{-- Tampilkan validasi error --}}
    @if ($errors->any())
    <div class="alert alert-danger" style="background-color:#f8d7da; padding:10px; border-radius:5px; margin-bottom:15px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tempatsejarah.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Nama Destinasi:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea><br><br>

        <label for="location">Lokasi:</label>
        <input type="text" id="location" name="location" value="{{ old('location') }}" required><br><br>

        <label for="category">Kategori:</label>
        <input type="text" id="category" name="category" value="{{ old('category') }}" required placeholder="Masukkan kategori (misal: Candi, Kolam, Museum)"><br><br>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required placeholder="Masukkan harga destinasi"><br><br>

        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <button type="submit">Tambah Destinasi</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById("hamburger").onclick = function () {
    var menu = document.getElementById("nav-menu");
    menu.classList.toggle("active"); // Toggle class active untuk menampilkan/menyembunyikan menu
};
</script>
@endsection

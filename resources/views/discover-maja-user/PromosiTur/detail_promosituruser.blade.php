<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Promosi - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/PromosiTur/detail_promositur.css') }}" />
</head>
<body>

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
        <li class="center-menu"><a href="{{ route('tempatsejarah.user.index') }}">Tempat Bersejarah</a></li>
        <li class="center-menu"><a href="{{ route('homepromositur.user.index') }}" class="active">Paket Tur</a></li>
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

<div style="padding-top: 120px;"></div>

<!-- Detail Promosi -->
<div class="promo-detail">
    <h2>{{ $promo->name }}</h2>
    <p class="promo-category">Kategori: {{ ucfirst($promo->category) }}</p>
    <p class="promo-price">Harga: Rp {{ number_format($promo->price, 2, ',', '.') }}</p>
    <p>Lokasi: {{ $promo->location }}</p>
    <p>Deskripsi: {{ $promo->description }}</p>

    @if ($promo->image)
        <img src="{{ asset('uploads/' . $promo->image) }}" alt="Gambar Paket" width="300" /><br><br>
    @else
        <p>Tidak ada gambar untuk paket ini.</p>
    @endif

    <a href="{{ route('pesan.promosi', ['id' => $promo->id]) }}" class="btn-pesan">Pesan Sekarang</a>
</div>

<a href="{{ route('homepromositur.user.index') }}" class="back-button">Kembali ke Daftar</a>

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
    document.getElementById("hamburger").onclick = function () {
    var menu = document.getElementById("nav-menu");
    menu.classList.toggle("active");
};
</script>

</body>
</html>
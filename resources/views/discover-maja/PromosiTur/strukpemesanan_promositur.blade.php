<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Struk Pemesanan - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/PromosiTur/strukpemesanan_promositur.css') }}" />
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
        <li class="center-menu"><a href="{{ url('ArtikelSejarah') }}">Artikel Bersejarah</a></li>
        <li class="center-menu"><a href="{{ url('TempatSejarah') }}">Tempat Bersejarah</a></li>
        <li class="center-menu"><a href="{{ route('homepromositur.index') }}" class="active">Paket Tur</a></li>
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

<div style="padding-top: 120px;"></div>

<!-- Struk Pemesanan -->
<div class="struk-form">
  <h2>Struk Pemesanan: {{ $pemesanan->nama_pemesanan }}</h2>
  <p><strong>Jumlah Orang: </strong>{{ $pemesanan->jumlah_orang }}</p>
  <p><strong>Tanggal Kunjungan: </strong>{{ $pemesanan->tanggal_kunjungan->format('d-m-Y') }}</p>
  <p><strong>Total Harga: </strong>Rp {{ number_format($pemesanan->total_harga, 2, ',', '.') }}</p>
  <p><strong>Metode Pembayaran: </strong>{{ $pemesanan->metode_pembayaran }}</p>

  <a href="{{ route('promosi-tur.user.detail', $pemesanan->promosi_id) }}" class="back-button">Kembali ke Detail Promosi</a>
  <a href="javascript:window.print()" class="button">Cetak Struk</a>
</div>

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
  document.getElementById("hamburger").onclick = function () {
    document.getElementById("nav-menu").classList.toggle("active");
  };
</script>

</body>
</html>

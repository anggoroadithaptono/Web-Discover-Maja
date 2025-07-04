<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Promosi & Paket Tur - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/PromosiTur/homepromositur.css') }}" />
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

<div style="padding-top: 100px;"></div>

<!-- Filter Kategori -->
<div class="filter-container">
  <form method="GET" action="{{ route('homepromositur.user.index') }}">
    <label for="category">Filter Kategori:</label>
    <select id="category" name="category" onchange="this.form.submit()">
      <option value="Semua" @if ($filter_category == 'Semua') selected @endif>Semua Kategori</option>
      @foreach ($kategori_result as $kategori)
        <option value="{{ $kategori->category }}" @if ($filter_category == $kategori->category) selected @endif>
          {{ ucfirst($kategori->category) }}
        </option>
      @endforeach
    </select>
  </form>
</div>

<!-- Formulir Pencarian -->
<form action="{{ route('homepromositur.user.index') }}" method="GET" class="search-form" style="text-align:center; margin:20px 0;">
  @if ($filter_category !== 'Semua')
    <input type="hidden" name="category" value="{{ $filter_category }}">
  @endif
  <input type="text" name="search" placeholder="Cari promosi, tur, lokasi, harga..." value="{{ $search_keyword }}">
  <button type="submit">Cari</button>
</form>

<!-- Section: Promo -->
<section class="promo-section">
  <h2>Promosi & Paket Tur</h2>
  <div class="container">
    @if ($promosi_tur->isNotEmpty())
      @foreach ($promosi_tur as $promo)
        <div class="promo-card">
          @if ($promo->image)
            <img src="{{ asset('uploads/' . $promo->image) }}" alt="Gambar Paket" class="promo-image" width="300" />
          @endif
          <h3>{{ $promo->name }}</h3>
          <p>{{ Str::limit($promo->description, 100) }}...</p>
          <a href="{{ route('promosi-tur.user.detail', $promo->id) }}" class="delete-button">Lihat Detail</a>
        </div>
      @endforeach
    @else
      <p style="text-align:center;">Tidak ada promosi atau paket tur ditemukan.</p>
    @endif
  </div>
</section>

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
  document.getElementById("hamburger").onclick = function () {
    document.getElementById("nav-menu").classList.toggle("active");
  };

  function changeLanguage() {
    // Integrasikan sistem ubah bahasa jika diperlukan
  }
</script>

</body>
</html>

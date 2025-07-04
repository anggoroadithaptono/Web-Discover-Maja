<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Artikel - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/Artikel/detailartikel.css') }}" />
</head>
<body>

<div class="header-wrapper">
  <header>
    <div class="logo-container">
      <<img src="{{ asset('images/lambangawal.png') }}" alt="logo" class="logo-img">
      <h1 class="logo-title">Discover Maja</h1>
    </div>

    <div class="hamburger" id="hamburger">
      <span class="hamburger-icon">&#9776;</span>
    </div>

    <div class="nav-menu" id="nav-menu">
      <ul>
                <li class="center-menu"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="center-menu"><a href="{{ route('artikel.index') }}" class="active">Artikel Bersejarah</a></li>
                <li class="center-menu"><a href="{{ route('tempatsejarah.user.index') }}">Tempat Bersejarah</a></li>
                <li class="center-menu"><a href="{{ route('homepromositur.user.index') }}">Paket Tur</a></li>
      </ul>
      <div class="header-right">
        <div class="auth-buttons">
          <a href="{{ url('/login') }}" class="button">Sign In</a>
          <a href="{{ url('/signup') }}" class="button">Sign Up</a>
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

<!-- Artikel Detail -->
<div class="article-detail">
  <h2>{{ $article->title }}</h2>

  @if (!empty($article->image))
    <img src="{{ asset('uploads/' . $article->image) }}" alt="Gambar {{ $article->title }}" class="article-image" style="max-width:100%; height:auto;">
  @else
    <p>Gambar tidak tersedia.</p>
  @endif

  <p class="article-date">{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</p>
  <p class="article-author">Penulis: {{ $article->nama_author }}</p>
  <p class="article-category">Kategori: {{ ucfirst($article->category) }}</p>

  <p>Deskripsi: {!! nl2br(e($article->content)) !!}</p>
</div>

<a href="{{ route('artikel.index') }}" class="back-button">Kembali ke Daftar</a>

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

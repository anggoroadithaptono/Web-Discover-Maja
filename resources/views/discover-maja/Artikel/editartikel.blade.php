<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Artikel - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/Artikel/editartikel.css') }}" />
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
                <li class="center-menu"><a href="{{ route('artikel.index') }}">Artikel Bersejarah</a></li>
                <li class="center-menu"><a href="{{ url('/tempat-sejarah') }}">Tempat Bersejarah</a></li>
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

  <div style="padding-top: 120px;"></div>

<!-- Form Edit Artikel -->
  @extends('layouts.app')

@section('content')
<div class="edit-form">
    <h3>Edit Artikel</h3>
    <form action="{{ route('artikel.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Judul Artikel:</label>
        <input type="text" id="title" name="title" value="{{ $article->title }}" required><br><br>

        <label for="content">Konten Artikel:</label>
        <textarea id="content" name="content" required>{{ $article->content }}</textarea><br><br>

        <label for="category">Kategori:</label>
        <input type="text" id="category" name="category" value="{{ $article->category }}" required><br><br>

        <label>Upload Gambar Baru (opsional):</label>
        <input type="file" name="image"><br><br>

        @if (!empty($article->image))
            <p>Gambar Lama:</p>
            <img src="{{ asset('uploads/' . $article->image) }}" alt="Gambar Lama" style="max-width: 200px;">
        @endif

        <button type="submit" name="update_article">Update Artikel</button>
    </form>

    <a href="{{ route('artikel.show', $article->id) }}" class="back-button">Kembali ke Artikel</a>
</div>

  <footer>
    &copy; 2025 Discover Maja - Trowulan Heritage Project
  </footer>

@endsection

  <script>
    document.getElementById("hamburger").onclick = function () {
    var menu = document.getElementById("nav-menu");
    menu.classList.toggle("active"); // Toggle class active untuk menampilkan/menyembunyikan menu
};
  </script>
</body>
</html>

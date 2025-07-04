<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Artikel - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/Artikel/tambahartikel.css') }}" />
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

  <!-- Form Tambah Artikel -->
  <div class="container">
    <h2>Tambah Artikel Tempat Bersejarah</h2>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

     <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Judul:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required><br><br>

        <label for="content">Konten:</label>
        <textarea id="content" name="content" required>{{ old('content') }}</textarea><br><br>

        <label for="author">Nama Penulis:</label>
        <input type="text" id="author" name="author" value="{{ old('author') }}"><br><br>

        <label for="category">Kategori:</label>
        <input type="text" id="category" name="category" value="{{ old('category') }}" required placeholder="Masukkan kategori (misal: Candi, Kolam, Museum)"><br><br>

        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <button type="submit">Simpan Artikel</button>
    </form>
  </div>

  <footer>
    &copy; 2025 Discover Maja - Trowulan Heritage Project
  </footer>

  <script>
    document.getElementById("hamburger").onclick = function () {
    var menu = document.getElementById("nav-menu");
    menu.classList.toggle("active"); // Toggle class active untuk menampilkan/menyembunyikan menu
};
  </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Promosi Tur - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/PromosiTur/edit_promositur.css') }}" />
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
        <li class="center-menu"><a href="{{ route('tempatsejarah.index') }}">Tempat Bersejarah</a></li>
        <li class="center-menu"><a href="{{ route('homepromositur.index') }}" class="active">Paket Tur</a></li>
      </ul>

      <div class="header-right">
        <div class="auth-buttons">
          <a href="{{ url('login') }}" class="button">Sign In</a>
          <a href="{{ url('register') }}" class="button">Sign Up</a>
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

<div class="container">
  <h2>Edit Paket Tur</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('update.promosi', $promo->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="name">Nama Paket:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $promo->name) }}" required><br><br>

    <label for="description">Deskripsi:</label>
    <textarea id="description" name="description" required>{{ old('description', $promo->description) }}</textarea><br><br>

    <label for="category">Kategori:</label>
    <input type="text" id="category" name="category" value="{{ old('category', $promo->category) }}" required><br><br>

    <label for="price">Harga:</label>
    <input type="number" id="price" name="price" value="{{ old('price', $promo->price) }}" required><br><br>

    <label for="location">Lokasi:</label>
    <input type="text" id="location" name="location" value="{{ old('location', $promo->location) }}" required><br><br>

    <label for="image">Gambar:</label><br>
    @if ($promo->image)
      <img src="{{ asset('uploads/' . $promo->image) }}" alt="Gambar Paket" width="100" /><br><br>
    @endif
    <input type="file" id="image" name="image" accept="image/*"><br><br>

    <button type="submit" name="update_paket">Update Paket</button>
  </form>
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

@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css//TempatSejarah/edittempatsejarah.css') }}">

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
        <li class="center-menu"><a href="{{ route('tempatsejarah.index') }}">Tempat Bersejarah</a></li>
        <li class="center-menu"><a href="#" class="active">Edit Destinasi</a></li>
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

<div class="container">
  <h2>Edit Destinasi</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('tempatsejarah.update', $tempatSejarah->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="name">Nama Destinasi:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $tempatSejarah->name) }}" required><br><br>

    <label for="description">Deskripsi:</label>
    <textarea id="description" name="description" required>{{ old('description', $tempatSejarah->description) }}</textarea><br><br>

    <label for="location">Lokasi:</label>
    <input type="text" id="location" name="location" value="{{ old('location', $tempatSejarah->location) }}" required><br><br>

    <label for="category">Kategori:</label>
    <input type="text" id="category" name="category" value="{{ old('category', $tempatSejarah->category) }}" required><br><br>

    <label for="image">Gambar Baru (opsional):</label>
    <input type="file" id="image" name="image" accept="image/*"><br><br>

    @if($tempatSejarah->image)
      <p>Gambar Saat Ini:</p>
      <img src="{{ asset('uploads/' . $tempatSejarah->image) }}" alt="Gambar Destinasi" style="max-width: 200px;">
    @endif

    <button type="submit">Perbarui Destinasi</button>
  </form>
</div>

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
  document.getElementById("hamburger").onclick = function () {
    var menu = document.getElementById("nav-menu");
    menu.classList.toggle("active");
  };
</script>
@endsection

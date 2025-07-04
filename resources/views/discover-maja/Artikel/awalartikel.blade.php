@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/Artikel/AwalArtikelSejarah.css') }}">

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Artikel Bersejarah - Discover Maja</title>
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
                <li class="center-menu"><a href="{{ route('artikel.index') }}" class="active">Artikel Bersejarah</a></li>
                <li class="center-menu"><a href="{{ url('/tempat-sejarah') }}">Tempat Bersejarah</a></li>
                <li class="center-menu"><a href="{{ route('homepromositur.index') }}">Paket Tur</a></li>
            </ul>

            <div class="header-right">
                <div class="auth-buttons">
                    <a href="login.html" class="button">Sign In</a>
                    <a href="signup.html" class="button">Sign Up</a>
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

{{-- PENTING: Panggil komponen Livewire HomeArticle di sini --}}
<livewire:home-article />

<footer>
    &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>
@endsection

@push('scripts')
<script>
    // JavaScript untuk hamburger menu
    document.getElementById("hamburger")?.addEventListener("click", () => {
        document.getElementById("nav-menu")?.classList.toggle("active");
    });

    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('nav-menu')?.classList.remove('active');
        });
    });

    // Fungsi changeLanguage() jika masih diperlukan untuk header
    function changeLanguage() {
        console.log('Language changed to: ', document.getElementById('language-selector').value);
        // Implementasi logika perubahan bahasa di sini
    }
</script>
@endpush
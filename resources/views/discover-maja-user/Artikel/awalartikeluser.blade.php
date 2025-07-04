@extends('layouts.app')

@section('title', 'Artikel Bersejarah')

    <link rel="stylesheet" href="{{ asset('css/Artikel/AwalArtikelSejarah.css') }}">

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
                <li class="center-menu"><a href="{{ route('artikel.index') }}" class="active">Artikel Bersejarah</a></li>
                <li class="center-menu"><a href="{{ route('tempatsejarah.user.index') }}">Tempat Bersejarah</a></li>
                <li class="center-menu"><a href="{{ route('homepromositur.user.index') }}">Paket Tur</a></li>
            </ul>

            <div class="header-right">
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="button">Sign In</a>
                    <a href="{{ route('register') }}" class="button">Sign Up</a>
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

{{-- Livewire komponen khusus pengguna (tanpa hak tambah/hapus) --}}
<livewire:home-article-user />

<footer>
    &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>
@endsection

@push('scripts')
<script>
    document.getElementById("hamburger")?.addEventListener("click", () => {
        document.getElementById("nav-menu")?.classList.toggle("active");
    });

    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('nav-menu')?.classList.remove('active');
        });
    });

    function changeLanguage() {
        const lang = document.getElementById('language-selector').value;
        console.log("Language changed to:", lang);
    }
</script>
@endpush
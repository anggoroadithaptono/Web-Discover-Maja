<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lihat Pembelian - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/PromosiTur/lihatpembelian_promositur.css') }}" />
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

<div class="purchase-table">
  <h2>Daftar Pembelian</h2>
  <table>
    <thead>
      <tr>
        <th>ID Pemesanan</th>
        <th>Nama Pemesan</th>
        <th>Jumlah Orang</th>
        <th>Tanggal Kunjungan</th>
        <th>Email</th>
        <th>Total Harga</th>
        <th>Metode Pembayaran</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pembelian as $row)
      <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->nama_pemesanan }}</td>
        <td>{{ $row->jumlah_orang }}</td>
        <td>{{ $row->tanggal_kunjungan }}</td>
        <td>{{ $row->email }}</td>
        <td>Rp {{ number_format($row->total_harga, 2, ',', '.') }}</td>
        <td>{{ $row->metode_pembayaran }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <a href="{{ route('homepromositur.index') }}" class="back-button">Kembali ke Paket Tur</a>
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

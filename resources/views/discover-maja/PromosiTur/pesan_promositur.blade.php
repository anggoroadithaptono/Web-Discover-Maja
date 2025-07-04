<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pesan Promosi - Discover Maja</title>
  <link rel="stylesheet" href="{{ asset('css/PromosiTur/pesan_promositur.css') }}" />
  <script>
    function hitungTotalHarga() {
      var jumlahOrang = document.getElementById('jumlah_orang').value || 0;
      var harga = {{ $promo->price }};
      var totalHarga = harga * jumlahOrang;
      document.getElementById('total_harga').innerText = "Total Harga: Rp " + totalHarga.toLocaleString('id-ID');
    }
  </script>
</head>
<body>

<div class="header-wrapper">
  <header>
    <div class="logo-container">
      <img src="{{ asset('images/PAM GANTENG.png') }}" alt="logo" class="logo-img" />
      <h1 class="logo-title">Discover Maja</h1>
    </div>

    <div class="hamburger" id="hamburger">
      <span class="hamburger-icon">&#9776;</span>
    </div>

    <div class="nav-menu" id="nav-menu">
      <ul>
         <li class="center-menu"><a href="{{ url('/') }}">Beranda</a></li>
        <li class="center-menu"><a href="{{ route('artikel.index') }}">Artikel Bersejarah</a></li>
        <li class="center-menu"><a href="{{ route('tempatsejarah.index')}}">Tempat Bersejarah</a></li>
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

<div class="pesan-form">
  <h2>Pesan Paket: {{ $promo->name }}</h2>
  <p><strong>Harga: </strong>Rp {{ number_format($promo->price, 0, ',', '.') }}</p>
  <p><strong>Kategori: </strong>{{ ucfirst($promo->category) }}</p>

  @if (session('success'))
    <div class="alert alert-success" style="color: green; font-weight: bold;">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('promosi-tur.submitPesan', $promo->id) }}" method="POST">
    @csrf
    <label for="nama_pemesanan">Nama Pemesan:</label>
    <input type="text" id="nama_pemesanan" name="nama_pemesanan" required><br><br>

    <label for="jumlah_orang">Jumlah Orang:</label>
    <input type="number" id="jumlah_orang" name="jumlah_orang" required oninput="hitungTotalHarga()"><br><br>

    <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
    <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="metode_pembayaran">Metode Pembayaran:</label>
    <select id="metode_pembayaran" name="metode_pembayaran" required>
      <option value="Transfer Bank">Transfer Bank</option>
      <option value="Kartu Kredit">Kartu Kredit</option>
      <option value="PayPal">PayPal</option>
    </select><br><br>

    <p id="total_harga">Total Harga: Rp 0</p>

    <button type="submit">Pesan Sekarang</button>
  </form>

  <a href="{{ route('promosi-tur.user.detail', $promo->id) }}" class="back-button">Kembali ke Detail Promosi</a>
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

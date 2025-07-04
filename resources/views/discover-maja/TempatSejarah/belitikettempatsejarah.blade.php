<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Beli Tiket - {{ $destinasi->name }}</title>
  <link rel="stylesheet" href="{{ asset('css/TempatSejarah/belitikettempatsejarah.css') }}" />
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
        <li class="center-menu"><a href="{{ url('ArtikelSejarah') }}">Artikel Bersejarah</a></li>
        <li class="center-menu"><a href="#" onclick="window.location.reload();" class="active">Tempat Bersejarah</a></li>
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

<section class="ticket-section" >
  <h2>Pembelian Tiket untuk {{ $destinasi->name }}</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="ticket-form" action="{{ route('belitiket.process') }}" method="POST">
    @csrf
    <input type="hidden" name="destinasi_id" value="{{ $destinasi->id }}">

    <label for="ticket-type">Jenis Tiket:</label>
    <select id="ticket-type" name="ticket_type" required>
      <option value="personal">Individu</option>
      <option value="group">Grup</option>
      <option value="guide">Tur Pemandu</option>
    </select>

    <label for="nama_pemesanan">Nama Pemesan:</label>
    <input type="text" id="nama_pemesanan" name="nama_pemesanan" required><br><br>

    <label for="jumlah_orang">Jumlah Orang:</label>
    <input type="number" id="jumlah_orang" name="jumlah_orang" required min="1" oninput="hitungTotalHarga()"><br><br>

    <label for="visit-date">Tanggal Kunjungan:</label>
    <input type="date" id="visit-date" name="visit_date" required>

    <label for="visit-time">Waktu Kunjungan:</label>
    <input type="time" id="visit-time" name="visit_time" required>

    <label for="payment-method">Metode Pembayaran:</label>
    <select id="payment-method" name="payment_method" required>
      <option value="credit">Kartu Kredit/Debit</option>
      <option value="transfer">Transfer Bank</option>
      <option value="digital">Pembayaran Digital</option>
    </select>

    <p><strong>Total Harga: </strong><span id="total-harga">Rp 0</span></p>

    <button type="submit">Beli Tiket</button>
  </form>
</section>

<footer>
  &copy; 2025 Discover Maja - Trowulan Heritage Project
</footer>

<script>
  const hargaTiket = {{ $destinasi->harga }};

  function hitungTotalHarga() {
    var jumlahOrang = document.getElementById('jumlah_orang').value || 0;
    var totalHarga = hargaTiket * jumlahOrang;
    document.getElementById('total-harga').innerText = "Rp " + totalHarga.toLocaleString('id-ID');
  }

  document.getElementById("hamburger").onclick = function () {
    var menu = document.getElementById("nav-menu");
    menu.classList.toggle("active");
  };
</script>

</body>
</html>

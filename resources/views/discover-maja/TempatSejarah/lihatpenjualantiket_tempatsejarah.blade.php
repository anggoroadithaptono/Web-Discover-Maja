<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Pembelian Tiket</title>
  <link rel="stylesheet" href="{{ asset('css/TempatSejarah/lihatpenjualantiket_tempatsejarah.css') }}" />
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
              <li class="center-menu"><a href="index.php">Beranda</a></li>
              <li class="center-menu"><a href="{{ route('artikel.index') }}">Artikel Bersejarah</a></li>
              <li class="center-menu"><a href="#" onclick="window.location.reload();" class="active">Tempat Bersejarah</a></li>
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

<section class="pembelian-section">
  <h2>Daftar Pembelian Tiket</h2>
  <table>
    <thead>
      <tr>
        <th>Destinasi</th>
        <th>Nama Pemesan</th>
        <th>Jumlah Orang</th>
        <th>Jenis Tiket</th>
        <th>Tanggal Kunjungan</th>
        <th>Waktu Kunjungan</th>
        <th>Total Harga</th>
        <th>Metode Pembayaran</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tickets as $ticket)
        <tr>
          <td>{{ $ticket->destinasi->name }}</td>
          <td>{{ $ticket->nama_pemesanan }}</td>
          <td>{{ $ticket->jumlah_orang }}</td>
          <td>{{ ucfirst($ticket->ticket_type) }}</td>
          <td>{{ $ticket->visit_date }}</td>
          <td>{{ $ticket->visit_time }}</td>
          <td>Rp {{ number_format($ticket->total_harga, 2, ',', '.') }}</td>
          <td>{{ ucfirst($ticket->payment_method) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</section>

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

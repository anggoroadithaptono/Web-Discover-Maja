<html>
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Discover Maja</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Link untuk Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

  </head>
  
  <body>
  <div id="splash-screen">
  <div class="splash-content">
    <img src="{{ asset('images/lambangawal.png') }}" alt="Logo">
    <p>Selamat Datang di Discover Maja</p>
  </div>
</div>

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
              <li class="center-menu"><a href="{{ url('/') }}" class="active">Beranda</a></li>
              <li class="center-menu"><a href="{{ route('artikel.user') }}">Artikel Bersejarah</a></li>
              <li class="center-menu"><a href="{{ route('tempatsejarah.user.index') }}">Tempat Bersejarah</a></li>
              <li class="center-menu"><a href="{{ route('homepromositur.user.index') }}">Paket Tur</a></li>

            </ul>
              <div class="header-right">
                <div class="auth-buttons">
                  <a href="{{ route('login') }}" class="button">Sign In</a>
                  <a href="{{ route('register') }}" class="button">Sign Up</a>
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

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-text" data-aos="fade-right">
      <h1>Eksplor Warisan Majapahit</h1>
      <p>Kenali kemegahan Trowulan, peninggalan sejarah kebanggaan Mojokerto dan Nusantara.</p>
        <a href="#home" class="btn-explore">Jelajahi Sekarang</a>
    </div>
    <div class="hero-image" data-aos="fade-left">
      <img src="{{ asset('images/lambangawal.png') }}" alt="Trowulan Heritage">
    </div>
  </section>


      <!-- Statistik Pengunjung -->
<section class="chart-section" style="padding: 2rem; background-color: #fff9f3; margin-top: 2rem;">
  <h2 style="text-align: center; color: #4b2e2e; margin-bottom: 1rem;">Statistik Pembelian Wisatawan</h2>
  <canvas id="salesChart" height="70"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ticketRaw = [
    @foreach($ticketData as $data)
      { tanggal: "{{ $data->tanggal }}", total: {{ $data->total }} },
    @endforeach
  ];

  const promoRaw = [
    @foreach($promosiData as $data)
      { tanggal: "{{ $data->tanggal }}", total: {{ $data->total }} },
    @endforeach
  ];

  const allDatesSet = new Set([
    ...ticketRaw.map(d => d.tanggal),
    ...promoRaw.map(d => d.tanggal),
  ]);

  const labels = Array.from(allDatesSet).sort();

  const mapToObject = (arr) => {
    const obj = {};
    arr.forEach(d => obj[d.tanggal] = d.total);
    return obj;
  }

  const ticketMap = mapToObject(ticketRaw);
  const promoMap = mapToObject(promoRaw);

  const ticketDataset = labels.map(date => ticketMap[date] || 0);
  const promoDataset = labels.map(date => promoMap[date] || 0);

  const ctx = document.getElementById('salesChart').getContext('2d');
  const salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Penjualan Tiket Tempat Sejarah',
          data: ticketDataset,
          backgroundColor: '#ff6f00'
        },
        {
          label: 'Pemesanan Promo Tur',
          data: promoDataset,
          backgroundColor: '#4c0606'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'Data Jumlah Pemesanan Tiket dan Tur per Tanggal',
          font: { size: 16 }
        },
        legend: {
          position: 'bottom'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });
</script>
  <div style="margin-top: 2rem; text-align: center;">
  <h3 style="color: #4b2e2e;">Total Pendapatan</h3>
  
  <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap; margin-top: 10px;">
    <p><strong>Penjualan Tiket Tempat Sejarah:</strong> Rp{{ number_format($totalUangTiket, 0, ',', '.') }}</p>
    <p><strong>Pemesanan Promosi Tur:</strong> Rp{{ number_format($totalUangPromo, 0, ',', '.') }}</p>
  </div>

  <div style="margin-top: 10px;">
    <p><strong>Total Keseluruhan:</strong> Rp{{ number_format($totalUangTiket + $totalUangPromo, 0, ',', '.') }}</p>
  </div>
</div>

</section>

  <!-- AOS Script -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

    <!-- Rest of your existing body content -->
    <section id="home" class="home">
      <div class="video-container">
        <video autoplay loop muted playsinline>
          <source src="{{ asset('videos/Candi Brahu Trowulan Mojokerto (DJI Mavic 2 Pro) Drone Cinematic Video.mp4') }}" type="video/mp4">
          Browser Anda tidak mendukung tag video.
        </video>
        <div class="overlay"></div>
        <div class="welcome-text">
          <h2 class="marquee-text">Selamat Datang di <span>Discover Maja</span></h2>
          <p>Jelajahi lebih banyak informasi dan pengetahuan yang bermanfaat!</p>
        </div>
      </div>
    </section>
    

    <!-- About Me Section -->
    <section  class="about-me">
      <h2>Tentang Discover Maja</h2>
      <p>Discover Maja adalah sebuah platform yang didedikasikan untuk menggali dan memperkenalkan kekayaan warisan budaya serta destinasi wisata di kawasan Maja. Kami menyajikan informasi lengkap mengenai situs-situs bersejarah, layanan pemesanan tiket, paket tur, pelaku usaha lokal, dan berbagai hal menarik lainnya seputar pariwisata Maja. Dengan semangat menjaga kelestarian budaya dan lingkungan, Discover Maja hadir untuk mendorong pariwisata yang berkelanjutan serta memperkuat apresiasi terhadap keindahan dan kearifan lokal. Kami percaya bahwa setiap sudut Maja memiliki cerita yang layak untuk ditemukan, dijaga, dan dibagikan kepada dunia.</p>
    </section>

    <!-- Embedded YouTube Video -->
    <section class="youtube-video">
      <h2>Watch Our Video</h2>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/nmY-n3Sas7M?si=6FATNaaPFvb1BrHI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('salesChart').getContext('2d');

  const labels = [
    @foreach($ticketData as $data)
      "{{ $data->tanggal }}",
    @endforeach
  ];

  const ticketDataset = [
    @foreach($ticketData as $data)
      {{ $data->total }},
    @endforeach
  ];

  const promosiDataset = [
    @foreach($promosiData as $data)
      {{ $data->total }},
    @endforeach
  ];

  const salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Penjualan Tiket Tempat Sejarah',
          data: ticketDataset,
          backgroundColor: '#ff6f00'
        },
        {
          label: 'Pemesanan Promo Tur',
          data: promosiDataset,
          backgroundColor: '#4c0606'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'Data Jumlah Pemesanan Tiket dan Tur per Tanggal',
          font: { size: 16 }
        },
        legend: {
          position: 'bottom'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });
</script>


    <div class="maps-container">
  <div class="map-image">
    <img src="{{ asset('images/maps.png') }}" alt="Peta Discover Maja">
  </div>
  <div class="content">
    <h1>Discover Maja</h1>
    <strong>Ayo Kunjungi Kawasan Warisan Trowulan!</strong>
    <p id="short-text">
      Discover Maja adalah kawasan bersejarah peninggalan Kerajaan Majapahit yang dipenuhi dengan situs-situs kuno seperti candi, kolam kerajaan, gapura monumental, dan museum arkeologi. 
    </p>
    <p id="long-text" style="display: none;">
      Berlokasi di Kabupaten Mojokerto, Trowulan menjadi pusat dari kebesaran Majapahit yang legendaris. Dengan jalur heritage yang telah ditata, pengunjung bisa menjelajahi jejak sejarah dan budaya Nusantara dengan cara yang menyenangkan dan bermakna.
    </p>
    <a href="javascript:void(0);" class="btn" onclick="toggleText()">More Information ➜</a>
  </div>
</div>

<script>
  function toggleText() {
    var shortText = document.getElementById("short-text");
    var longText = document.getElementById("long-text");

    // Toggle the display of the long text
    if (longText.style.display === "none") {
      longText.style.display = "block";
      shortText.style.display = "none"; // Hide the short text
    } else {
      longText.style.display = "none";
      shortText.style.display = "block"; // Show the short text again
    }
  }
</script>

      

 <!-- Single Card Auto Slider -->
 <section class="slider-wrapper" id="sightseeing-tour">
    <div class="slider-text">
      <h2>Discover Maja Sightseeing Tour</h2>
      <p>Jelajahi keindahan dan sejarah Trowulan dengan becak wisata sambil mengunjungi situs-situs penting Majapahit. Nikmati pengalaman tur santai dan edukatif bersama pemandu lokal!</p>
      <a href="promosi_tur.php" class="btn-more-info">More Information ➜</a>
      </div>
    <div class="slider-image">
      <img src="{{ asset('images/MuseumMajapahit.jpeg') }}" alt="Museum Trowulan">
      <img src="{{ asset('images/CandiBajang.jpeg') }}" alt="Candi Brahu">
      <img src="{{ asset('images/CandiBrahu.jpeg') }}" alt="Makam Troloyo">
    </div>
  </section>

      <section class="events-container">
        <h2>Apa itu Discover Maja</h2>
        <p>Sedang mencari inspirasi untuk menjelajahi jantung budaya Maja? Temukan upacara adat terkini, peringatan bersejarah, pertunjukan seni lokal, dan pengalaman autentik yang menanti Anda!
        </p>
      
        <div class="events-slider">
          <div class="event-card">
            <div class="event-image">
              <img src="{{ asset('images/event 1.jpg') }}" alt="Event 1">
            </div>
            <div class="event-info">
              <h3>Event 1: Candi Darling Trowulan</h3>
              <p>27 Agustus 2024</p>
              <p class="event-description">Gabung dalam kegiatan "Candi Darling Trowulan", program penanaman pohon dan edukasi lingkungan di kawasan Cagar Budaya Nasional Trowulan. Selain menanam, peserta akan diajak menyusuri jejak peninggalan Kerajaan Majapahit. Terbatas hanya untuk 150 peserta!</p>
              <a href="#" class="button">Lihat Detail</a>

            </div>
          </div>
          <div class="event-card">
            <div class="event-image">
              <img src="{{ asset('images/event 2.jpg') }}" alt="Event 2">
            </div>
            <div class="event-info">
              <h3> Event 2: Tur Edukasi – Jejak Majapahit</h3>
              <p>15 Juli 2024 – 17 Juli 2024</p>
              <p class="event-description">Ikuti Tur Edukasi Menelusuri Jejak Kerajaan Majapahit, kegiatan literasi sejarah yang cocok untuk pelajar dan pecinta budaya. Jelajahi situs-situs penting seperti Candi Bajang Ratu, Candi Brahu, dan Museum Trowulan bersama pemandu budaya profesional.</p>
              <a href="#" class="button">Lihat Detail</a>

            </div>
          </div>
          <div class="event-card">
            <div class="event-image">
              <img src="{{ asset('images/event 3.jpg') }}" alt="Event 3">
            </div>
            <div class="event-info">
              <h3> Event 3: Festival Budaya Mojopahit</h3>
              <p>12 Mei 2024</p>
              <p class="event-description">Rayakan Hari Jadi Kabupaten Mojokerto dengan Festival Budaya Mojopahit! Saksikan pawai budaya, pertunjukan tari tradisional, parade kostum kerajaan, dan pentas seni lokal di pelataran Candi Bajang Ratu.</p>
              <a href="#" class="button">Lihat Detail</a>

            </div>
          </div>
        </div>
      </section>
      
      <section class="highlighted-heritage">
        <h2>Tempat Bersejarah Pilihan</h2>
        <p>Jelajahi peninggalan bersejarah terbaik dari Trowulan, Mojokerto!</p>
        <div class="heritage-preview">
          <div class="place-card">
            <div class="place-image">
              <img src="{{ asset('images/CandiBrahu.jpeg') }}" alt="Candi Brahu">
            </div>
            <div class="place-info">
              <h3>Candi Brahu</h3>
              <p>Salah satu candi peninggalan Kerajaan Majapahit yang bersejarah dan memesona.</p>
            </div>
          </div>
      
          <div class="place-card">
            <div class="place-image">
              <img src="{{ asset('images/kolamsaragan.jpeg') }}" alt="Kolam Segaran">
            </div>
            <div class="place-info">
              <h3>Kolam Segaran</h3>
              <p>Kolam bersejarah yang dulunya digunakan sebagai tempat rekreasi keluarga kerajaan.</p>
            </div>
          </div>
      
          <div class="place-card">
            <div class="place-image">
              <img src="{{ asset('images/MuseumMajapahit.jpeg') }}" alt="Museum Trowulan">
            </div>
            <div class="place-info">
              <h3>Museum Trowulan</h3>
              <p>Museum yang menyimpan artefak penting dari era Majapahit dan sejarah Jawa Timur.</p>
            </div>
          </div>
        </div>
      
        <div class="see-more">
          <a href="TempatSejarah.php" class="button">Lihat Semua Situs</a>
        </div>
      </section>
      
      <section id="galeri-wisata" class="gallery-section">
  <h2 style="text-align:center; color:#3e2f1c; margin-bottom:2rem">Galeri Wisata Peninggalan Majapahit</h2>
  <div class="gallery-scroll">
    <div class="gallery" id="autoScrollGallery">
      <div class="gallery-item" data-aos="fade-up">
        <img src="{{ asset('images/CandiBrahu.jpeg') }}" alt="Candi 1" />
      </div>
      <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ asset('images/MuseumMajapahit.jpeg') }}" alt="Candi 2" />
      </div>
      <div class="gallery-item" data-aos="fade-up" data-aos-delay="200">
        <img src="{{ asset('images/kolamsaragan.jpeg') }}" alt="Kota Tua" />
      </div>
      <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
        <img src="{{ asset('images/CandiBrahu.jpeg') }}" alt="Kuliner" />
      </div>
      <div class="gallery-item" data-aos="fade-up" data-aos-delay="400">
        <img src="{{ asset('images/CandiBajang.jpeg') }}" alt="Seni Tari" />
      </div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<style>
  .gallery-scroll {
    overflow-x: hidden;
    white-space: nowrap;
    padding: 1rem 2rem;
    position: relative;
  }
  .gallery {
    display: inline-flex;
    gap: 20px;
    animation: scrollGallery 40s linear infinite;
  }
  @keyframes scrollGallery {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
  }
  .gallery-item {
    width: 220px;
    flex-shrink: 0;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: white;
  }
  .gallery-item img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
  }
  .gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
  .gallery-item:hover img {
    transform: scale(1.05);
  }
</style>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>


        
      
      <!-- Bagian Kontak Kami yang baru -->
      <div class="container-center">
        <section id="kontak-kami-section" class="additional-info">
          <div class="contact-info">
            <h3>Contact Us</h3>
            <p>Dinas Kebudayaan, Kepemudaan dan Olahraga serta Pariwisata Kota Surabaya</p>
            <p>Kelurahan Genteng Kecamatan Genteng, Kota Surabaya Jawa Timur, Indonesia, 60275</p>
            <p>031–5340444</p>
            <p><a href="mailto:tic@surabaya.go.id">tic@surabaya.go.id</a></p>
          </div>
      
          <div class="other-sites">
            <h3>Our Other Sites</h3>
            <ul>
              <li><a href="#">Disbudporapar Surabaya</a></li>
              <li><a href="#">360° Surabaya</a></li>
              <li><a href="#">Tiket Wisata Surabaya</a></li>
              <li><a href="#">Katalog Museum Surabaya</a></li>
              <li><a href="#">Bangga Surabaya</a></li>
            </ul>
          </div>
      
          <div class="social-media">
            <h3>Connect</h3>
            <ul>
              <li><a href="#">Instagram</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Tiktok</a></li>
            </ul>
          </div>
        </section>
      </div>
      <section id="hubungi-kami" class="contact-form-section">
        <h2>Hubungi Kami</h2>
        
        <!-- Form Kontak -->
        <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
        @csrf
          <label for="name">Nama:</label>
          <input type="text" id="name" name="name" required>
      
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
      
          <label for="message">Pesan:</label>
          <textarea id="message" name="message" required></textarea>
      
          <button type="submit">Kirim Pesan</button>
        </form>
      
       <!-- Tampilkan Data Kontak -->
      <div class="tabel-kontak">
          <h3>Daftar Pesan Masuk</h3>
          @if($contacts->isEmpty())
              <p>Tidak ada pesan masuk.</p>
          @else
            <table>
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Pesan</th>
                      <th>Tanggal Masuk</th> {{-- Tambahan --}}
                  </tr>
              </thead>
              <tbody>
                  @foreach($contacts as $c)
                  <tr>
                      <td>{{ $c->name }}</td>
                      <td>{{ $c->email }}</td>
                      <td>{{ $c->message }}</td>
                      <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d-m-Y H:i') }}</td> {{-- Format waktu tampil --}}
                  </tr>
                  @endforeach
              </tbody>
          </table>
          @endif
      </div>
    </section>
      
          <!-- Floating WhatsApp Button -->
  <div class="floating-whatsapp" id="whatsapp-btn">
    <a href="https://wa.me/1234567890" target="_blank">
      <i class="fa-brands fa-whatsapp"></i>
    </a>
  </div>

    <footer>
      <p class="title" id="footer-text">&copy; Website 2025 : DISCOVER MAJA </p>
    </footer>
    
    <script>
  window.addEventListener("load", () => {
    setTimeout(() => {
      const splash = document.getElementById("splash-screen");
      splash.classList.add("fade-out");

      setTimeout(() => {
        splash.style.display = "none";
      }, 1000); // waktu untuk animasi fade-out (1 detik)
    }, 1000); // waktu tampil splash (10 detik)
  });

</script>


  </body>
</html>

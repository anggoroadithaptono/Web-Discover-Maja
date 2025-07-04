<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Struk Pembelian Tiket - {{ $ticket->destinasi->name }}</title>
  <link rel="stylesheet" href="{{ asset('css/TempatSejarah/cetaktikettempatsejarah.css') }}" />
</head>
<body>

<div class="ticket-details">
    <h2>Struk Pembelian Tiket</h2>
    <p><strong>Destinasi:</strong> {{ $ticket->destinasi->name }}</p>
    <p><strong>Tipe Tiket:</strong> {{ ucfirst($ticket->ticket_type) }}</p>
    <p><strong>Nama Pemesan:</strong> {{ $ticket->nama_pemesanan }}</p>
    <p><strong>Jumlah Orang:</strong> {{ $ticket->jumlah_orang }}</p>
    <p><strong>Tanggal Kunjungan:</strong> {{ $ticket->visit_date }}</p>
    <p><strong>Waktu Kunjungan:</strong> {{ $ticket->visit_time }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($ticket->total_harga, 2, ',', '.') }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($ticket->payment_method) }}</p>

    <button onclick="window.print()" class="print-button">Cetak Struk</button>
    <a href="{{ route('tempatsejarah.user.index') }}" class="back-button" >Kembali ke Tempat Bersejarah</a>
</div>

</body>
</html>

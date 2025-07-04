<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Font & Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  {{-- Navbar (opsional, bisa di-include) --}}
  @include('partials.navbar')

  <!-- Konten Utama -->
  @yield('content')

  <!-- Scripts global -->
  <script src="{{ asset('js/script.js') }}"></script>
  @stack('scripts')

</body>
</html>

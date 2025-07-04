<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Discover Maja</title>

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom Login CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
    <!-- Font Awesome (untuk ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="login-page flex items-center justify-center min-h-screen text-[#3e2f1c]">

    <div class="form-card fade-in">
        <h2 class="text-2xl font-bold mb-4">Login ke <span class="text-[#a67c52]">Discover Maja</span></h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->has('login'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-sm">
                {{ $errors->first('login') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="input-icon">
                <i class="fas fa-envelope"></i>
                <input id="email" type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-icon">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>

        <div class="link mt-4">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>

        <div class="social">
            <button><i class="fab fa-google"></i></button>
            <button><i class="fab fa-facebook-f"></i></button>
        </div>
    </div>

</body>
</html>

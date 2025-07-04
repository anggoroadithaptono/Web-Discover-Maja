<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('discover-maja-akun.login');
    }

    public function showRegisterForm()
    {
        return view('discover-maja-akun.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::table('users')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan sesi login pengguna
            session(['user' => $user]);

            // Cek email dan password admin (yang tidak dienkripsi karena kamu sebutkan langsung)
            if ($user->email === 'admin123@gmail.com' && $request->password === '123456') {
                return redirect()->route('home'); // views/discover-maja/home.blade.php
            } else {
                return redirect()->route('home.pengguna'); // views/discover-maja-user/homepengguna.blade.php
            }
        }

        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('home');
    }
}

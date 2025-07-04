<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\TempatSejarahController;
use App\Http\Controllers\PromosiTurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Livewire\HomeArticle;
use App\Http\Controllers\PageControllerPengguna;


Route::get('/', [PageControllerPengguna::class, 'homepengguna'])->name('homepengguna');
// Home khusus admin (Discover Maja)
Route::get('/homeadmin', [PageController::class, 'home'])->name('home');

Route::get('/homepengguna', [PageControllerPengguna::class, 'homepengguna'])->name('home.pengguna');

// Contact Form
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Rute untuk Artikel
// PENTING: Rute ini sekarang akan langsung menunjuk ke komponen Livewire HomeArticle
// yang akan menangani tampilan daftar, filter, pencarian, dan penghapusan.
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');

// Rute untuk delete artikel via controller DIHAPUS karena ditangani Livewire
Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.delete'); // <<< PERBAIKAN PENTING DI SINI

// Rute-rute Artikel yang masih ditangani oleh ArtikelController (Create, Store, Show, Edit, Update)
Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
Route::put('/artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');


// Rute untuk Tempat Sejarah
Route::get('/tempat-sejarah', [TempatSejarahController::class, 'index'])->name('tempatsejarah.index');
Route::get('/tempat-sejarah/{id}', [TempatSejarahController::class, 'show'])->name('tempatsejarah.show');
Route::delete('/tempat-sejarah/{id}', [TempatSejarahController::class, 'destroy'])->name('tempatsejarah.destroy');
Route::get('/tempatsejarah/create', [TempatSejarahController::class, 'create'])->name('tempatsejarah.create');
Route::post('/tempatsejarah', [TempatSejarahController::class, 'store'])->name('tempatsejarah.store');
Route::get('/tempat-sejarah/{id}/edit', [TempatSejarahController::class, 'edit'])->name('tempatsejarah.edit');
Route::put('/tempat-sejarah/{id}', [TempatSejarahController::class, 'update'])->name('tempatsejarah.update');

Route::get('/belitikettempatsejarah/{id}', [TempatSejarahController::class, 'showForm'])->name('belitiket.form');
Route::post('/belitikettempatsejarah', [TempatSejarahController::class, 'processForm'])->name('belitiket.process');
Route::get('/cetaktikettempatsejarah/{id}', [TempatSejarahController::class, 'cetakTiket'])->name('belitiket.cetak');
Route::get('/lihatpenjualantiket_tempatsejarah', [TempatSejarahController::class, 'lihatPenjualanTiket'])->name('penjualan.tiket');


// Rute untuk Promosi Tur
Route::get('/homepromositur', [PromosiTurController::class, 'index'])->name('homepromositur.index');
Route::delete('/hapus-promosi-tur/{id}', [PromosiTurController::class, 'hapusPromosi'])->name('hapus.promosi'); // Ini harusnya POST atau DELETE method

Route::get('/detail-promosi-tur/{id}', [PromosiTurController::class, 'detail'])->name('promosi-tur.detail');
Route::get('/pesan-promosi-tur/{id}', [PromosiTurController::class, 'pesan'])->name('pesan.promosi');
Route::get('/edit-promosi-tur/{id}', [PromosiTurController::class, 'edit'])->name('edit.promosi');
Route::post('/edit-promosi-tur/{id}', [PromosiTurController::class, 'update'])->name('update.promosi'); // Ini harusnya PUT method
Route::get('/tambah-promosi-tur', [PromosiTurController::class, 'create'])->name('promosi-tur.create');
Route::post('/tambah-promosi-tur', [PromosiTurController::class, 'store'])->name('promosi-tur.store');

// Jika Anda memiliki rute ganda untuk pesan.promosi, pertahankan salah satu yang paling Anda gunakan
Route::get('/promosi-tur/{id}/pesan', [PromosiTurController::class, 'pesan'])->name('promosi-tur.pesan');
Route::post('/promosi-tur/{id}/submit-pesan', [PromosiTurController::class, 'submitPesan'])->name('promosi-tur.submitPesan');
Route::get('/promosi-tur/{id}/struk', [PromosiTurController::class, 'strukPemesanan'])->name('promosi-tur.struk');
Route::get('/promosi-tur/lihat-pembelian', [PromosiTurController::class, 'lihatPembelian'])->name('promosi-tur.lihatPembelian');


// Rute untuk Pengguna
Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna');

// Rute untuk Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//User
Route::get('/artikel-user', function () {
    return view('discover-maja-user.Artikel.awalartikeluser');
})->name('artikel.user');
// Route user (tampilan tanpa tombol edit)
Route::get('/artikel-user/{id}', [ArtikelController::class, 'showUser'])->name('artikel.user.show');


Route::get('/tempat-sejarah-user', [TempatSejarahController::class, 'tempatSejarahUser'])->name('tempatsejarah.user.index');
Route::get('/tempat-sejarah-user/{id}', [TempatSejarahController::class, 'showUser'])->name('tempatsejarah.user.show');


// Halaman utama promosi tur untuk USER
Route::get('/promosi-tur-user', [PromosiTurController::class, 'indexUser'])->name('homepromositur.user.index');

// Halaman detail promosi tur untuk USER
Route::get('/promosi-tur-user/{id}', [PromosiTurController::class, 'showUser'])->name('promosi-tur.user.detail');

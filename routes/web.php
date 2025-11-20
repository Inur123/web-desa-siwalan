<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Guest\BeritaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Guest\LayananController;
use App\Http\Controllers\Guest\ProfileController;
use App\Http\Controllers\Guest\PengaduanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Warga\DashboardController as WargaDashboard;
use App\Http\Controllers\Warga\PengaduanController as WargaPengaduan;



// Authentication Routes
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/posts', PostController::class);
     Route::resource('admin/pengaduan', AdminPengaduanController::class)
        ->only(['index', 'show', 'destroy']);
});
// Dashboard User
Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga/dashboard', [WargaDashboard::class, 'index'])->name('warga.dashboard');
    Route::get('/warga/pengaduan', [WargaPengaduan::class, 'index'])->name('warga.pengaduan');
});

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('guest.home');
Route::get('/profil', [ProfileController::class, 'index'])->name('guest.profile');
Route::get('/layanan', [LayananController::class, 'index'])->name('guest.layanan');
Route::get('/berita', [BeritaController::class, 'index'])->name('guest.berita');
Route::get('/berita/{post:slug}', [BeritaController::class, 'show'])->name('berita.show');


// Pengaduan Routes
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('guest.pengaduan');
Route::post('/pengaduan/kirim', [PengaduanController::class, 'store'])
    ->middleware('auth')
    ->name('pengaduan.store');

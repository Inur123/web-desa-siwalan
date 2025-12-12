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
use App\Http\Controllers\Guest\Layanan\SktmController as GuestSktmController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Admin\Layanan\SktmController as AdminSktmController;

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

    // Admin SKTM Routes
    Route::prefix('admin/sktm')->name('admin.sktm.')->group(function () {
        Route::get('/', [AdminSktmController::class, 'index'])->name('index');
        Route::get('/{sktm}', [AdminSktmController::class, 'show'])->name('show');
        Route::get('/{sktm}/cetak', [AdminSktmController::class, 'cetak'])->name('cetak');
        Route::patch('/{sktm}/status', [AdminSktmController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{sktm}', [AdminSktmController::class, 'destroy'])->name('destroy');
    });

    // Admin Settings Routes
    Route::get('/admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
});

// Removed warga routes - only admin role exists now

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('guest.home');
Route::get('/profil', [ProfileController::class, 'index'])->name('guest.profile');
Route::get('/layanan', [LayananController::class, 'index'])->name('guest.layanan');
Route::get('/berita', [BeritaController::class, 'index'])->name('guest.berita');
Route::get('/berita/{post:slug}', [BeritaController::class, 'show'])->name('berita.show');


// Pengaduan Routes (No authentication required but with rate limiting)
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('guest.pengaduan');
Route::post('/pengaduan/kirim', [PengaduanController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('pengaduan.store');

// SKTM Routes (No authentication required but with rate limiting)
Route::get('/layanan/sktm', [GuestSktmController::class, 'index'])->name('guest.sktm');
Route::post('/layanan/sktm/kirim', [GuestSktmController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('guest.sktm.store');

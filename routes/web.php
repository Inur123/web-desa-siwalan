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
use App\Http\Controllers\Guest\CekStatusLayananController;
use App\Http\Controllers\Admin\Settings\FontteController;
use App\Http\Controllers\Admin\Settings\TemplateSuratController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\Layanan\SktmController as AdminSktmController;
use App\Http\Controllers\Guest\Layanan\SktmController as GuestSktmController;
use App\Http\Controllers\Admin\Layanan\SuratKehilanganController as AdminSuratKehilanganController;
use App\Http\Controllers\Guest\Layanan\SuratKehilanganController as GuestSuratKehilanganController;
use App\Http\Controllers\Admin\Layanan\SuratKeteranganDomisiliController as AdminSuratDomisiliController;
use App\Http\Controllers\Guest\Layanan\SuratKeteranganDomisiliController as GuestSuratDomisiliController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;

// Authentication Routes
// Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

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

    // Admin Surat Kehilangan Routes
    Route::prefix('admin/surat-kehilangan')->name('admin.surat-kehilangan.')->group(function () {
        Route::get('/', [AdminSuratKehilanganController::class, 'index'])->name('index');
        Route::get('/{suratKehilangan}', [AdminSuratKehilanganController::class, 'show'])->name('show');
        Route::get('/{suratKehilangan}/cetak', [AdminSuratKehilanganController::class, 'cetak'])->name('cetak');
        Route::patch('/{suratKehilangan}/status', [AdminSuratKehilanganController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{suratKehilangan}', [AdminSuratKehilanganController::class, 'destroy'])->name('destroy');
    });

    // Admin Surat Keterangan Domisili Routes
    Route::prefix('admin/surat-keterangan-domisili')->name('admin.surat-keterangan-domisili.')->group(function () {
        Route::get('/', [AdminSuratDomisiliController::class, 'index'])->name('index');
        Route::get('/{suratKeteranganDomisili}', [AdminSuratDomisiliController::class, 'show'])->name('show');
        Route::get('/{suratKeteranganDomisili}/cetak', [AdminSuratDomisiliController::class, 'cetak'])->name('cetak');
        Route::patch('/{suratKeteranganDomisili}/status', [AdminSuratDomisiliController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{suratKeteranganDomisili}', [AdminSuratDomisiliController::class, 'destroy'])->name('destroy');
    });

    // Admin Settings Routes
    Route::prefix('admin/settings')->name('admin.settings.')->group(function () {
        // Template Surat
        Route::get('/template-surat', [TemplateSuratController::class, 'index'])->name('template-surat.index');
        Route::put('/template-surat', [TemplateSuratController::class, 'update'])->name('template-surat.update');

        // Fonnte WhatsApp
        Route::get('/fonnte', [FontteController::class, 'index'])->name('fonnte.index');
        Route::put('/fonnte', [FontteController::class, 'update'])->name('fonnte.update');
    });
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

// Surat Kehilangan Routes (No authentication required but with rate limiting)
Route::get('/layanan/surat-kehilangan', [GuestSuratKehilanganController::class, 'index'])->name('guest.surat-kehilangan');
Route::post('/layanan/surat-kehilangan/kirim', [GuestSuratKehilanganController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('guest.surat-kehilangan.store');

// Surat Keterangan Domisili Routes (No authentication required but with rate limiting)
Route::get('/layanan/surat-keterangan-domisili', [GuestSuratDomisiliController::class, 'index'])->name('guest.surat-keterangan-domisili');
Route::post('/layanan/surat-keterangan-domisili/kirim', [GuestSuratDomisiliController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('guest.surat-keterangan-domisili.store');


 Route::get('/cek-status-layanan', [CekStatusLayananController::class, 'index'])
    ->name('guest.cek-status-layanan');

Route::post('/cek-status-layanan', [CekStatusLayananController::class, 'check'])
    ->name('guest.cek-status-layanan.check');

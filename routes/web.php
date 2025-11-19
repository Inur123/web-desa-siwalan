<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Guest\BeritaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Guest\LayananController;
use App\Http\Controllers\Guest\ProfileController;
use App\Http\Controllers\Guest\PengaduanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Warga\DashboardController as WargaDashboard;



// Authentication Routes
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])
    ->get('/admin/dashboard', [AdminDashboard::class, 'index'])
    ->name('admin.dashboard');

// Dashboard User
Route::middleware(['auth', 'role:warga'])
    ->get('/warga/dashboard', [WargaDashboard::class, 'index'])
    ->name('warga.dashboard');

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('guest.home');
Route::get('/profil', [ProfileController::class, 'index'])->name('guest.profile');
Route::get('/layanan', [LayananController::class, 'index'])->name('guest.layanan');
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('guest.pengaduan');
Route::get('/berita', [BeritaController::class, 'index'])->name('guest.berita');

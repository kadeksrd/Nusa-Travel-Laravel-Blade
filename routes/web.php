<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\RentalMobilController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/pesan', [HomeController::class, 'pesan'])->name('pesan');
Route::get('/terima-kasih', [HomeController::class, 'thankYou'])->name('thank-you');

// Paket Wisata
Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('paket-wisata.index');
Route::get('/paket-wisata/{paketWisata:slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.show');

// Rental Mobil
Route::get('/rental-mobil', [RentalMobilController::class, 'index'])->name('rental-mobil.index');
Route::get('/rental-mobil/{rentalMobil:slug}', [RentalMobilController::class, 'show'])->name('rental-mobil.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');

// Dashboard User (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/ulasan/{pemesanan}', [DashboardController::class, 'tulisUlasan'])->name('dashboard.ulasan');
});

// Auth routes (Breeze)
require __DIR__.'/auth.php';

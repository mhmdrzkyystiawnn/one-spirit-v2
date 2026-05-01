<?php

// Import semua Controller yang kita butuhkan
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MobilElfController;
use App\Http\Controllers\Admin\SupirController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;


// --- INI RUTE HALAMAN DEPAN (BAWAAN BREEZE) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/mobil', [HomeController::class, 'katalog'])->name('mobil.katalog');
Route::get('/mobil/{mobil}', [HomeController::class, 'showDetail'])->name('mobil.detail'); // <-- TAMBAHKAN INI

// ... (rute lain)

// --- BOOKING ROUTES ---
Route::get('/booking/{mobil}', [HomeController::class, 'showBookingForm'])->name('booking.form');
Route::post('/booking', [HomeController::class, 'storeBooking'])->name('booking.store');
Route::post('/api/available-drivers', [HomeController::class, 'getAvailableDrivers'])->name('api.available.drivers');
Route::get('/invoice/{booking}', [DashboardController::class, 'showInvoice'])
    ->middleware(['auth', 'verified'])->name('invoice.show');

Route::get('/review/create/{booking}', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');


// --- INI RUTE PROFIL PENGGUNA (BAWAAN BREEZE) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- INI RUTE ADMIN KITA YANG KEMARIN HILANG ---
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/admin/mobil', MobilElfController::class);
    Route::resource('/admin/supir', SupirController::class);
    Route::resource('/admin/users', UserController::class);
    Route::resource('/admin/booking', BookingController::class);
});


// Ini untuk manggil file rute login, register, dll. (BAWAAN BREEZE)
require __DIR__.'/auth.php';
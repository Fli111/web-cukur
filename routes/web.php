<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BookingController;


// Rute untuk Halaman (Tampilan)
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/book', [PageController::class, 'book'])->name('book');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/create', [PageController::class, 'create'])->name('create');
Route::get('/tanggal-book', [PageController::class, 'tanggalBook'])->name('tanggal_book');

// Rute untuk Proses Form (Aksi)
Route::post('/proses-register', [AuthController::class, 'register'])->name('proses.register');
Route::post('/proses-login', [AuthController::class, 'login'])->name('proses.login');
Route::post('/proses-booking', [BookingController::class, 'store'])->name('proses.booking');

// --- RUTE HALAMAN PUBLIK ---
Route::get('/ecommerceProductPage', [PageController::class, 'ecommerceProductPage']);
Route::get('/ecommerceProductDetail/{id}', [PageController::class, 'ecommerceProductDetail']);
Route::get('/ecommerceHomePage', [PageController::class, 'ecommerceHomePage']);

// --- RUTE KERANJANG & CHECKOUT ---
Route::get('/ecommerceCartPage', [CartController::class, 'showCart']);
Route::post('/cart/add/{id}', [CartController::class, 'addToCart']);
Route::post('/checkout', [CartController::class, 'prosesCheckout']);

// --- RUTE ADMIN (Dilindungi Middleware Pengecekan Session) ---
Route::middleware(['admin'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    
    // Tambah Produk
    Route::get('/admin/produk/tambah', [AdminController::class, 'create']);
    Route::post('/admin/produk/simpan', [AdminController::class, 'store']);
    
    // Edit Produk
    Route::get('/admin/produk/edit/{id}', [AdminController::class, 'edit']);
    Route::post('/admin/produk/update/{id}', [AdminController::class, 'update']);
    
    // Hapus Produk
    Route::get('/admin/produk/hapus/{id}', [AdminController::class, 'destroy']);
});
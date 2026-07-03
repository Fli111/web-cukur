<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;


// --- RUTE HALAMAN PUBLIK ---
Route::get('/', [PageController::class, 'home']);       // ← Landing page barbershop
Route::get('/shop', [PageController::class, 'homepage']);     // ← Halaman toko/produk
Route::get('/productpage', [PageController::class, 'productpage']);
Route::get('/productdetail/{id}', [PageController::class, 'productdetail']);


// --- RUTE AUTHENTICATION ---
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'prosesRegister']);
Route::get('/logout', [AuthController::class, 'logout']);


// --- RUTE KERANJANG & CHECKOUT ---
Route::get('/cartpage', [CartController::class, 'showCart']);
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
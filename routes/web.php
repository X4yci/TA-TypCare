<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Rute Halaman Pembeli & Katalog Publik (Auto-Filter H-3)
|--------------------------------------------------------------------------
*/
Route::get('/', [CatalogController::class, 'welcome'])->name('home');
Route::get('/introduction', [CatalogController::class, 'introduction'])->name('introduction');
Route::get('/beranda', [CatalogController::class, 'beranda'])->name('beranda');
Route::get('/home', [CatalogController::class, 'beranda'])->name('user.home');
Route::get('/products', [CatalogController::class, 'index'])->name('products');
Route::get('/product', [CatalogController::class, 'index'])->name('product');

// Transaksi Checkout FEFO, Simulasi Pembayaran, & AI Chatbot Konsultasi Jamu
Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/payments/{pesananId}/simulate', [PaymentController::class, 'simulasiBayar'])->name('payments.simulate');
Route::post('/chatbot/konsultasi', [ChatbotController::class, 'konsultasi'])->name('chatbot.konsultasi');

/*
|--------------------------------------------------------------------------
| 2. Rute Autentikasi & Kontrol Sesi Role (Pembeli vs Pemilik/Admin)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/login/google', [AuthController::class, 'loginGoogle'])->name('login.google');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. Rute Backoffice Pemilik / Admin (Validasi Email Khusus Pemilik)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

Route::post('/admin/inventory/batch', [InventoryController::class, 'storeBatch'])->name('admin.inventory.store');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::post('/admin/shipping/{pesananId}', [ShippingController::class, 'updateKurir'])->name('admin.shipping.update');
Route::get('/admin/reports/export', [ReportController::class, 'exportLaporan'])->name('admin.reports.export');

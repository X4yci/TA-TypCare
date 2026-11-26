<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\TypCareController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Rute Halaman Pembeli & Katalog Publik (Terhubung ke SQLite via TypCareController)
|--------------------------------------------------------------------------
*/
Route::get('/', [TypCareController::class, 'welcome'])->name('home');
Route::get('/introduction', [TypCareController::class, 'introduction'])->name('introduction');
Route::get('/beranda', [TypCareController::class, 'beranda'])->name('beranda');
Route::get('/home', [TypCareController::class, 'beranda'])->name('user.home');
Route::get('/products', [TypCareController::class, 'catalog'])->name('products');
Route::get('/product', [TypCareController::class, 'catalog'])->name('product');

// Keranjang (Session), Checkout FEFO, Simulasi Pembayaran, & AI Chatbot SQLite Context
Route::post('/cart/add', [TypCareController::class, 'addToCart'])->name('cart.add');
Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/payments/{pesananId}/simulate', [PaymentController::class, 'simulasiBayar'])->name('payments.simulate');
Route::post('/chatbot/konsultasi', [TypCareController::class, 'chatbot'])->name('chatbot.konsultasi');

/*
|--------------------------------------------------------------------------
| 2. Rute Autentikasi & Kontrol Sesi Role (SQLite Model Admin & Customer)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [TypCareController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/login/google', [AuthController::class, 'loginGoogle'])->name('login.google');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [TypCareController::class, 'register'])->name('register.submit');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 3. Rute Backoffice Pemilik / Admin (CRUD Data Barang SQLite)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [TypCareController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboard', [TypCareController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/products', [TypCareController::class, 'adminProducts'])->name('admin.products');
Route::get('/admin/produk', [TypCareController::class, 'adminProducts'])->name('admin.produk');
Route::get('/admin/orders', [TypCareController::class, 'adminOrders'])->name('admin.orders');
Route::get('/admin/pesanan', [TypCareController::class, 'adminOrders'])->name('admin.pesanan');
Route::get('/admin/reports', [TypCareController::class, 'adminReports'])->name('admin.reports');
Route::get('/admin/laporan', [TypCareController::class, 'adminReports'])->name('admin.laporan');

Route::post('/admin/products/save', [TypCareController::class, 'storeOrUpdateProduct'])->name('admin.products.save');
Route::delete('/admin/products/{id}', [TypCareController::class, 'deleteProduct'])->name('admin.products.delete');

Route::post('/admin/inventory/batch', [InventoryController::class, 'storeBatch'])->name('admin.inventory.store');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::post('/admin/shipping/{pesananId}', [ShippingController::class, 'updateKurir'])->name('admin.shipping.update');
Route::get('/admin/reports/export', [ReportController::class, 'exportLaporan'])->name('admin.reports.export');

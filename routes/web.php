<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/home', function () {
    return view('beranda');
})->name('user.home');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/product', function () {
    return view('products');
})->name('product');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/login/google', [AuthController::class, 'loginGoogle'])->name('login.google');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

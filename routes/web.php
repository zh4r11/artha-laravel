<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/register-buyer', [UserController::class, 'storeBuyer'])->name('register.buyer');
Route::post('/register-admin', [UserController::class, 'storeAdmin'])->name('register.admin');

Route::get('/', 'App\Http\Controllers\ProdukController@index')->name('index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail');

Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart-delete', [CartController::class, 'destroy'])->name('cart.delete');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
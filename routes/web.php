<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;

Route::get('/admin-page', function () {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/login', function () {
    return view('admin.login');
})->name('login');

Route::post('/login-processed', [AuthController::class, 'login'])->name('login-processed');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/register-buyer', [UserController::class, 'storeBuyer'])->name('register.buyer');
Route::post('/register-admin', [UserController::class, 'storeAdmin'])->name('register.admin');

Route::get('/', 'App\Http\Controllers\ProdukController@indexStore')->name('index-store');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail');

Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart-delete', [CartController::class, 'destroy'])->name('cart.delete');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-page', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    
    Route::prefix('admin-page')->group(function () {
        Route::get('/produk-list', [ProdukController::class, 'getAllProduks'])->name('produk-list');
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
        Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::post('/produk/update', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    });
});
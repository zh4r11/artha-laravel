<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/register-buyer', [UserController::class, 'storeBuyer'])->name('register.buyer');
Route::post('/register-admin', [UserController::class, 'storeAdmin'])->name('register.admin');

Route::get('/', 'App\Http\Controllers\ProdukController@index')->name('index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail');


Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
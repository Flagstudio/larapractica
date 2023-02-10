<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart', [CartProductController::class, 'create'])
    ->name('cart.addProduct');

Route::delete('/cart/{product}', [CartProductController::class, 'delete'])
    ->name('cart.removeProduct');

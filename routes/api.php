<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart', [CartProductController::class, 'store'])
    ->name('cart.addProduct');

Route::delete('/cart/{product}', [CartProductController::class, 'delete'])
    ->name('cart.removeProduct');

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.list');

Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');

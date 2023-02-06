<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
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

Route::post('/cart', [CartItemController::class, 'create'])
    ->name('cart.addItem');

Route::delete('/cart/{product}', [CartItemController::class, 'delete'])
    ->name('cart.removeItem');

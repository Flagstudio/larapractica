<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
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

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->name('categories.show');

Route::get('/categories/{category}/products', [CategoryProductController::class, 'index'])
    ->name('categories.products.index');

Route::get('/categories/{category}/products/{product}', [CategoryProductController::class, 'show'])
    ->name('categories.products.show');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart', [CartProductController::class, 'store'])
    ->name('cart.addProduct');

Route::delete('/cart/{product}', [CartProductController::class, 'delete'])
    ->name('cart.removeProduct');

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.list');

Route::get('/orders/{order}', [OrderController::class, 'get'])
    ->name('orders.show');

Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');

Route::delete('/orders', [OrderController::class, 'delete'])
    ->name('orders.cancel');

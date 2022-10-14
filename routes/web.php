<?php

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

Route::view('/', 'main.index')->name('main');

Route::get('robots.txt', \App\Http\Controllers\RobotsController::class)->name('robots');
Route::get('sitemap.xml', \App\Http\Controllers\SitemapController::class)->name('sitemap');

Route::view('/search', 'search.index')
    ->name('search');

Route::get('/products', \App\Http\Livewire\Products\Filters::class)
    ->name('products');

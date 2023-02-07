<?php

namespace App\ViewModels;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Spatie\ViewModels\ViewModel;

class CartPageViewModel extends ViewModel
{
    protected $view = 'cart.index';

    public function __construct() {}

    public function products(): Collection
    {
        return collect(Session::get('productsInCart', []));
    }

    public function relatedProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }
}

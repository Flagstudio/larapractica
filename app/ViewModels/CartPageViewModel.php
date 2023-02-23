<?php

namespace App\ViewModels;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Spatie\ViewModels\ViewModel;

class CartPageViewModel extends ViewModel
{
    protected $view = 'cart.index';

    public function __construct(
        private CartService $cart,
    ) {}

    public function products(): Collection
    {
        $cart = $this->cart->getProducts();

        $productsInCart = array_keys($cart);

        return Product::find($productsInCart)
            ->each(fn ($product) => $product->quantity = $cart[$product->id]);
    }

    public function relatedProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }

    public function client(): array
    {
        return [
            'name' => 'Alex',
            'address' => '',
        ];
    }

    public function viewed(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }
}

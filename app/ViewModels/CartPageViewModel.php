<?php

namespace App\ViewModels;

use App\Http\Resources\CartProductsResource;
use App\Models\Product;
use App\Services\CartService;
use Spatie\ViewModels\ViewModel;

class CartPageViewModel extends ViewModel
{
    protected $view = 'cart.index';

    public function __construct(
        private CartService $cart,
    ) {}

    public function products(): array
    {
        $cart = $this->cart->getProducts();

        $productsInCart = array_keys($cart);

        return CartProductsResource::collection(
            Product::find($productsInCart)
        )
            ->withCart($cart)
            ->jsonSerialize();
    }
}

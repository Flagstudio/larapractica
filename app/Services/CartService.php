<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const PRODUCTS = 'productsInCart';

    public function addProduct(Product $product, int $quantity = 1): void
    {
        $productsInCart = Session::get(self::PRODUCTS, []);

        if (isset($productsInCart[$product->id])) {
            $productsInCart[$product->id] += $quantity;
        } else {
            $productsInCart[$product->id] = $quantity;
        }

        Session::put(self::PRODUCTS, $productsInCart);
    }

    public function removeProduct(Product $product): void
    {
        $productsInCart = Session::get(self::PRODUCTS, []);
        unset($productsInCart[$product->id]);
        Session::put(self::PRODUCTS, $productsInCart);
    }

    public function quantityProduct(Product $product): int
    {
        return Session::get(self::PRODUCTS, [])[$product->id] ?? 0;
    }

    public function getProducts(): array
    {
        return Session::get(self::PRODUCTS, []);
    }
}

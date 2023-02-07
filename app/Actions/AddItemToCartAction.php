<?php

namespace App\Actions;

use App\Data\AddToCartData;
use App\Exceptions\InsufficientQuantityProductException;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AddItemToCartAction
{
    public function run(AddToCartData $data): void
    {
        try {
            DB::beginTransaction();

            $product = Product::firstWhere('id', $data->productId);

            if ($product->quantity < $data->quantity) {
                throw new InsufficientQuantityProductException();
            }

            $productsInCart = Session::get('productsInCart', []);

            if (isset($productsInCart[$data->productId])) {
                $productsInCart[$data->productId] += $data->quantity;
            } else {
                $productsInCart[$data->productId] = $data->quantity;
            }

            Session::put('productsInCart', $productsInCart);

            $product->decrement('quantity', $data->quantity);

            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
        }
    }
}

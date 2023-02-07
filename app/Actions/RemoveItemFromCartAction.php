<?php

namespace App\Actions;

use App\Data\RemoveFromCartData;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RemoveItemFromCartAction
{
    public function run(RemoveFromCartData $data): void
    {
        try {
            DB::beginTransaction();

            $product = Product::firstWhere('id', $data->productId);

            $productsInCart = Session::get('productsInCart', []);

            if (isset($productsInCart[$data->productId])) {
                $product->increment('quantity', $productsInCart[$data->productId]);

                unset($productsInCart[$data->productId]);
                Session::put('productsInCart', $productsInCart);
            }

            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
        }
    }
}

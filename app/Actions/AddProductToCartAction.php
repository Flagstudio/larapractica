<?php

namespace App\Actions;

use App\Data\AddToCartData;
use App\Exceptions\InsufficientQuantityProductException;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddProductToCartAction
{
    public function __construct(
        private CartService $cart,
    ) {}

    public function run(AddToCartData $data): void
    {
        try {
            DB::beginTransaction();

            $product = Product::firstWhere('id', $data->productId);

            if ($product->quantity < $data->quantity) {
                throw new InsufficientQuantityProductException();
            }

            $this->cart->addProduct($product, $data->quantity);

            $product->decrement('quantity', $data->quantity);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
        }
    }
}

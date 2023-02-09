<?php

namespace App\Actions;

use App\Data\RemoveFromCartData;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RemoveItemFromCartAction
{
    public function __construct(
        private CartService $cart,
    ) {}

    public function run(RemoveFromCartData $data): void
    {
        try {
            DB::beginTransaction();

            $product = Product::firstWhere('id', $data->productId);

            if($quantity = $this->cart->quantityProduct($product)) {
                $this->cart->removeProduct($product);
                $product->increment('quantity', $quantity);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
        }
    }
}

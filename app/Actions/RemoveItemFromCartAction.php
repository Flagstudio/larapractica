<?php

namespace App\Actions;

use App\Data\RemoveFromCartData;
use Illuminate\Support\Facades\Session;

class RemoveItemFromCartAction
{
    public function run(RemoveFromCartData $data): void
    {
        $productsInCart = collect(Session::get('productsInCart', []));

        $productsInCart->except([$data->productId]);
    }
}

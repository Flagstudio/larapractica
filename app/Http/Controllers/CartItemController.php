<?php

namespace App\Http\Controllers;

use App\Actions\AddItemToCartAction;
use App\Actions\RemoveItemFromCartAction;
use App\Data\AddToCartData;
use App\Data\RemoveFromCartData;
use App\Http\Requests\AddItemToCartRequest;
use App\Http\Requests\RemoveItemFromCartRequest;

class CartItemController extends Controller
{
    public function create(AddItemToCartRequest $request, AddItemToCartAction $action)
    {
        dd($request->validated());
        $action->run(new AddToCartData(...$request->validated()));

        return response()
            ->json([
                'status' => 'success'
            ]);
    }

    public function delete(RemoveItemFromCartRequest $request, RemoveItemFromCartAction $action)
    {
        $action->run(new RemoveFromCartData(...$request->validated()));

        return response()
            ->json([
                'status' => 'success'
            ]);
    }
}

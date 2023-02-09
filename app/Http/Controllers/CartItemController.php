<?php

namespace App\Http\Controllers;

use App\Actions\AddItemToCartAction;
use App\Actions\RemoveItemFromCartAction;
use App\Http\Requests\AddItemToCartRequest;
use App\Http\Requests\RemoveItemFromCartRequest;

class CartItemController extends Controller
{
    public function create(AddItemToCartRequest $request, AddItemToCartAction $action)
    {
        $action->run($request->getData());

        return response()
            ->json([
                'status' => 'success'
            ]);
    }

    public function delete(RemoveItemFromCartRequest $request, RemoveItemFromCartAction $action)
    {
        $action->run($request->getData());

        return response()
            ->json([
                'status' => 'success'
            ]);
    }
}

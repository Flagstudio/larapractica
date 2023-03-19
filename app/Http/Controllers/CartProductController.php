<?php

namespace App\Http\Controllers;

use App\Actions\AddProductToCartAction;
use App\Actions\RemoveProductFromCartAction;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\RemoveProductFromCartRequest;

class CartProductController extends Controller
{
    public function store(AddProductToCartRequest $request, AddProductToCartAction $action)
    {
        $action->run($request->getData());

        return response()
            ->json([
                'status' => 'success'
            ]);
    }

    public function delete(RemoveProductFromCartRequest $request, RemoveProductFromCartAction $action)
    {
        $action->run($request->getData());

        return response()
            ->json([
                'status' => 'success'
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\AddProductToCartAction;
use App\Actions\RemoveProductFromCartAction;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\RemoveProductFromCartRequest;
use App\Swagger\Responses\ErrorResponse;
use App\Swagger\Responses\SuccessResponse;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;

class CartProductController extends Controller
{
    #[Post(
        path: '/api/cart',
        description: 'Add product in cart',
        summary: 'Add product in cart',
        security: [['DeviceUUID' => []]],
        requestBody: new RequestBody(
            content: new JsonContent(ref: AddProductToCartRequest::class),
        ),
        tags: ['Cart'],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(ref: SuccessResponse::class),
    )]
    #[Response(
        response: 404,
        description: 'Product not found',
        content: new JsonContent(ref: ErrorResponse::class, example: ['message' => 'Товар не найден']),
    )]
    public function store(AddProductToCartRequest $request, AddProductToCartAction $action)
    {
        $action->run($request->getData());

        return response()
            ->json([
                'status' => 'success'
            ]);
    }

    #[Delete(
        path: '/api/cart/{product}',
        description: 'Remove product from cart',
        summary: 'Remove product from cart',
        security: [['DeviceUUID' => []]],
        tags: ['Cart'],
        parameters: [
            new Parameter(ref: '#components/parameters/product'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(ref: SuccessResponse::class),
    )]
    #[Response(
        response: 404,
        description: 'Product not found',
        content: new JsonContent(ref: ErrorResponse::class, example: ['message' => 'Товар не найден']),
    )]
    public function delete(RemoveProductFromCartRequest $request, RemoveProductFromCartAction $action)
    {
        $action->run($request->getData());

        return response()
            ->json([
                'status' => 'success'
            ]);
    }
}

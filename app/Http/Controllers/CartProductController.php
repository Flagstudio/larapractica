<?php

namespace App\Http\Controllers;

use App\Actions\AddProductToCartAction;
use App\Actions\RemoveProductFromCartAction;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\RemoveProductFromCartRequest;
use App\Http\Resources\OrdersListResource;
use App\Responses\OrderNotFoundResponse;
use OpenApi\Attributes as OA;

class CartProductController extends Controller
{
    #[OA\Post(
        path: "/api/cart",
        description: "Return orders list",
        summary: "Get orders list",
        security: [['X-Device-UUID' => []]],
        tags: ['Cart'],
        parameters: [
            new OA\Parameter(
                name: 'status',
                description: 'Status of a order',
                in: 'query',
                schema: new OA\Schema(ref: '#components/schemas/OrderStatusEnum'),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'Page of orders list',
                in: 'query',
                schema: new OA\Schema(type: 'integer'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'The data',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: OrdersListResource::class),
        ),
    )]
    #[OA\Response(
        response: 404,
        description: 'Orders not found',
        content: new OA\JsonContent(ref: OrderNotFoundResponse::class),
    )]
    public function store(AddProductToCartRequest $request, AddProductToCartAction $action)
    {
        $action->run($request->getData());

        return response()
            ->json([
                'status' => 'success'
            ]);
    }

    #[OA\Delete(
        path: "/api/cart",
        description: "Return orders list",
        summary: "Get orders list",
        security: [['X-Device-UUID' => []]],
        tags: ['Cart'],
        parameters: [
            new OA\Parameter(
                name: 'status',
                description: 'Status of a order',
                in: 'query',
                schema: new OA\Schema(ref: '#components/schemas/OrderStatusEnum'),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'Page of orders list',
                in: 'query',
                schema: new OA\Schema(type: 'integer'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'The data',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: OrdersListResource::class),
        ),
    )]
    #[OA\Response(
        response: 404,
        description: 'Orders not found',
        content: new OA\JsonContent(ref: OrderNotFoundResponse::class),
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

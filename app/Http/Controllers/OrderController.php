<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrdersListResource;
use App\Models\Order;
use App\Swagger\Responses\ErrorResponse;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;

class OrderController extends Controller
{
    #[Get(
        path: "/api/orders",
        description: "Return orders list",
        summary: "Get orders list",
        security: [['X-Device-UUID' => []]],
        tags: ['Orders'],
        parameters: [
            new Parameter(ref: '#components/parameters/status'),
            new Parameter(ref: '#components/parameters/page'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(
            type: 'array',
            items: new Items(ref: OrdersListResource::class),
        ),
    )]
    #[Response(
        response: 401,
        description: 'Unauthorized',
    )]
    public function index(Request $request): JsonResponse
    {
        $orders = Order::query();

        $orders->when(
            $request->input('status'),
            fn (Builder $query) => $query->whereStatus($request->input('status')),
        );

        return new JsonResponse(
            OrdersListResource::collection(
                $orders->get()
            )
        );
    }

    #[Get(
        path: "/api/orders/{order}",
        description: "Return order",
        summary: "Get orders",
        security: [['X-Device-UUID' => []]],
        tags: ['Orders'],
        parameters: [
            new Parameter(ref: '#components/parameters/order'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(ref: OrdersListResource::class),
    )]
    #[Response(
        response: 401,
        description: 'Unauthorized',
    )]
    #[Response(
        response: 404,
        description: 'Order not found',
        content: new JsonContent(ref: ErrorResponse::class, example: ['message' => 'Заказ не найден']),
    )]
    public function show(Order $order): JsonResponse
    {
        return new JsonResponse(
            new OrdersListResource($order)
        );
    }

    #[Post(
        path: "/api/orders",
        description: "Return new order",
        summary: "Create new order",
        security: [['X-Device-UUID' => []]],
        requestBody: new RequestBody(
            content: new JsonContent(ref: StoreOrderRequest::class),
        ),
        tags: ['Orders'],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(ref: OrdersListResource::class),
    )]
    #[Response(
        response: 401,
        description: 'Unauthorized',
    )]
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = Order::create($request->validated());

        return new JsonResponse(
            new OrdersListResource($order)
        );
    }

    #[Delete(
        path: "/api/orders/{order}",
        description: "Cancel order",
        summary: "Cancel orders",
        security: [['X-Device-UUID' => []]],
        tags: ['Orders'],
        parameters: [
            new Parameter(ref: '#components/parameters/order'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(
            type: 'object',
            example: [],
        ),
    )]
    #[Response(
        response: 401,
        description: 'Unauthorized',
    )]
    #[Response(
        response: 404,
        description: 'Order not found',
        content: new JsonContent(ref: ErrorResponse::class, example: ['message' => 'Заказ не найден']),
    )]
    public function delete(Order $order): JsonResponse
    {
        $order->delete();

        return new JsonResponse([]);
    }
}

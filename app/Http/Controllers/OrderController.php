<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrdersListResource;
use App\Models\Order;
use App\Responses\OrderNotFoundResponse;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{
    #[OA\Get(
        path: "/api/orders",
        description: "Return orders list",
        summary: "Get orders list",
        security: [['X-Device-UUID' => []]],
        tags: ['Orders'],
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

    #[OA\Get(
        path: "/api/orders/{order}",
        description: "Return order",
        summary: "Get orders",
        security: [['X-Device-UUID' => []]],
        tags: ['Orders'],
        parameters: [
            new OA\Parameter(
                name: 'order',
                description: 'Order id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'The data',
        content: new OA\JsonContent(ref: OrdersListResource::class),
    )]
    #[OA\Response(
        response: 404,
        description: 'Order not found',
        content: new OA\JsonContent(ref: OrderNotFoundResponse::class),
    )]
    public function show(Order $order)
    {
        return new JsonResponse(
            new OrdersListResource($order)
        );
    }

    #[OA\Post(
        path: "/api/orders",
        description: "Return new order",
        summary: "Create new order",
        security: [['X-Device-UUID' => []]],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(ref: '#components/schemas/StoreOrderRequest'),
        ),
        tags: ['Orders'],
    )]
    #[OA\Response(
        response: 200,
        description: 'The data',
        content: new OA\JsonContent(ref: OrdersListResource::class),
    )]
    #[OA\Response(
        response: 404,
        description: 'Order not found',
        content: new OA\JsonContent(ref: OrderNotFoundResponse::class),
    )]
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());

        return new JsonResponse(
            new OrdersListResource($order)
        );
    }

    #[OA\Delete(
        path: "/api/orders/{order}",
        description: "Cancel order",
        summary: "Cancel orders",
        security: [['X-Device-UUID' => []]],
        tags: ['Orders'],
        parameters: [
            new OA\Parameter(
                name: 'order',
                description: 'Order id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'The data',
        content: new OA\JsonContent(
            type: 'object',
            example: [],
        ),
    )]
    #[OA\Response(
        response: 404,
        description: 'Order not found',
        content: new OA\JsonContent(ref: OrderNotFoundResponse::class),
    )]
    public function delete(Order $order)
    {
        return new JsonResponse([]);
    }
}

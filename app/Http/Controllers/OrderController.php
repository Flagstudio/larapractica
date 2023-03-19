<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrdersListResource;
use App\Models\Order;
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
        tags: ['Orders'],
        parameters: [
            new OA\Parameter(
                name: 'status',
                description: 'Status of a order',
                in: 'query',
            ),
        ],

    )]
    #[OA\Response(
        response: 200,
        description: 'The data',
        content: new OA\JsonContent(ref: '#components/schemas/OrdersListResource'),
    )]
    #[OA\Response(
        response: 404,
        description: 'Orders not found',
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

    public function show(Order $order)
    {
        return new JsonResponse(
            new OrdersListResource($order)
        );
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());

        return new JsonResponse(
            new OrdersListResource($order)
        );
    }
}

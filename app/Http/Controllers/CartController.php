<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartProductsResource;
use App\ViewModels\CartPageViewModel;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Response;
use Spatie\ViewModels\ViewModel;

class CartController extends Controller
{
    #[Get(
        path: "/api/cart",
        description: "Return products list in cart",
        summary: "Get products list in cart",
        security: [['X-Device-UUID' => []]],
        tags: ['Cart'],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(
            type: 'array',
            items: new Items(ref: CartProductsResource::class),
        ),
    )]
    #[Response(
        response: 401,
        description: 'Unauthorized',
    )]
    public function index(CartPageViewModel $viewModel): ViewModel|JsonResponse
    {
        return $viewModel;
    }
}

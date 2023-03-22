<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductsResource;
use App\Models\Category;
use App\Models\Product;
use App\Swagger\Responses\ErrorResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\Examples;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Response;

class CategoryProductController extends Controller
{
    #[Get(
        path: "/api/categories/{category}/products",
        description: "Return products list of category",
        summary: "Get products list of category",
        tags: ['Category'],
        parameters: [
            new Parameter(ref: '#components/parameters/category'),
            new Parameter(ref: '#components/parameters/page'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(type: 'array', items: new Items(ref: ProductsResource::class)),
    )]
    #[Response(
        response: 404,
        description: 'Category not found',
        content: new JsonContent(ref: ErrorResponse::class, example: ['message' => 'Категория не найдена']),
    )]
    public function index(Category $category): JsonResponse
    {
        return new JsonResponse(
            ProductsResource::collection($category->products)
        );
    }

    #[Get(
        path: "/api/categories/{category}/products/{product}",
        description: "Return products list of category",
        summary: "Get products list of category",
        tags: ['Category'],
        parameters: [
            new Parameter(ref: '#components/parameters/category'),
            new Parameter(ref: '#components/parameters/product'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(ref: ProductsResource::class),
    )]
    #[Response(
        response: 404,
        description: 'Not found',
        content: new JsonContent(
            examples: [
                new Examples(
                    example: 'Category not found',
                    summary: 'Category not found',
                    value: ['message' => 'Категория не найден'],
                ),
                new Examples(
                    example: 'Product not found',
                    summary: 'Product not found',
                    value: ['message' => 'Товар не найден'],
                ),
            ],
            ref: ErrorResponse::class,
        ),
    )]
    public function show(Category $category, Product $product): JsonResponse
    {
        return new JsonResponse(
            new ProductsResource($product)
        );
    }
}

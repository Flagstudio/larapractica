<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Swagger\Responses\ErrorResponse;
use App\Swagger\Responses\SuccessResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Response;

class CategoryController extends Controller
{
    #[Get(
        path: "/api/categories",
        description: "Return categories list",
        summary: "Get categories list",
        tags: ['Category'],
        parameters: [
            new Parameter(ref: '#components/parameters/page'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(ref: SuccessResponse::class),
    )]
    public function index(): JsonResponse
    {
        return new JsonResponse(
            CategoryResource::collection([])
        );
    }

    #[Get(
        path: "/api/categories/{category}",
        description: "Return the category",
        summary: "Get the category",
        tags: ['Category'],
        parameters: [
            new Parameter(ref: '#components/parameters/category'),
        ],
    )]
    #[Response(
        response: 200,
        description: 'The data',
        content: new JsonContent(ref: SuccessResponse::class),
    )]
    #[Response(
        response: 404,
        description: 'Category not found',
        content: new JsonContent(ref: ErrorResponse::class, example: ['message' => 'Категория не найдена']),
    )]
    public function show(Category $category): JsonResponse
    {
        return new JsonResponse(
            new CategoryResource($category)
        );
    }
}

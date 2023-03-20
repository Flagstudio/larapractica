<?php

namespace App\Responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ErrorResponse',
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
        ),
    ],
    type: 'object',
    example: [
        'message' => 'Order not found',
    ],
)]
class OrderNotFoundResponse
{

}

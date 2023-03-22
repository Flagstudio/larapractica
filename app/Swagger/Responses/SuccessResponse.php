<?php

namespace App\Swagger\Responses;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    title: 'SuccessResponse',
    required: ['status'],
    properties: [
        new Property(
            property: 'status',
            type: 'string',
            example: 'success',
        ),
    ],
    type: 'object',
    example: [
        'status' => 'success',
    ],
)]
class SuccessResponse
{

}

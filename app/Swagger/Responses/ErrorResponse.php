<?php

namespace App\Swagger\Responses;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    title: 'ErrorResponse',
    required: ['message'],
    properties: [
        new Property(
            property: 'message',
            type: 'string',
        ),
    ],
    type: 'object',
)]
class ErrorResponse
{

}

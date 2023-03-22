<?php

namespace App\Swagger\Parameters;

use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Schema;

#[Parameter(
    parameter: 'order',
    name: 'order',
    description: 'ID заказа',
    in: 'path',
    required: true,
    schema: new Schema(type: 'integer'),
    example: 1,
)]
class OrderId
{

}

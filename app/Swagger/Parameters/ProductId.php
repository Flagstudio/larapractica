<?php

namespace App\Swagger\Parameters;

use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Schema;

#[Parameter(
    parameter: 'product',
    name: 'product',
    description: 'ID товара',
    in: 'path',
    required: true,
    schema: new Schema(type: 'integer'),
    example: 1,
)]
class ProductId
{

}

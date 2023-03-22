<?php

namespace App\Swagger\Parameters;

use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Schema;

#[Parameter(
    parameter: 'category',
    name: 'category',
    description: 'ID категории',
    in: 'path',
    required: true,
    schema: new Schema(type: 'integer'),
    example: 1,
)]
class CategoryId
{

}

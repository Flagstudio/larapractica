<?php

namespace App\Swagger\Parameters;

use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Schema;

#[Parameter(
    parameter: 'page',
    name: 'page',
    description: 'Номер страницы',
    in: 'query',
    schema: new Schema(type: 'integer'),
    example: 2,
)]
class Page
{

}

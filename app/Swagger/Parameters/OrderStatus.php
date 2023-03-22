<?php

namespace App\Swagger\Parameters;

use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Schema;

#[Parameter(
    parameter: 'status',
    name: 'status',
    description: 'Статус заказа',
    in: 'query',
    schema: new Schema(ref: '#components/schemas/OrderStatusEnum'),
    example: 1,
)]
class OrderStatus
{

}

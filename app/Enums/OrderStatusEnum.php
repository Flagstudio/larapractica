<?php

namespace App\Enums;

use OpenApi\Attributes\Schema;

#[Schema(title: 'OrderStatusEnum', type: 'integer')]
enum OrderStatusEnum: int
{
    case new = 0;

    case pending = 1;

    case paid = 2;

    case failed = 3;

    case canceled = 4;
}

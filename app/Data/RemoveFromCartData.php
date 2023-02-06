<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class RemoveFromCartData extends Data
{
    public function __construct(
        public int $productId,
    ) {}
}

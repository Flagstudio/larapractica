<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class FilterProductDTO extends DataTransferObject
{
    public readonly array $colors;

    public readonly int $category;

    public readonly int $priceMin;

    public readonly int $priceMax;
}

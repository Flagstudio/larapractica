<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;
use Spatie\DataTransferObject\DataTransferObject;

class FilteredProductDTO extends DataTransferObject
{
    public readonly Collection $products;

    public readonly array $facets;
}

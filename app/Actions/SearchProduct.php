<?php

namespace App\Actions;

use App\Models\Product;

class SearchProduct
{
    public function handle(string $query = '')
    {
        return $query !== ''
            ? Product::search($query)->paginate()
            : [];
    }
}

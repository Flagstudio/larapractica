<?php

namespace App\Actions;

use App\DTO\FilterProductDTO;
use App\Models\Product;

class FilterProduct
{
    public function handle(FilterProductDTO $data)
    {
        return Product::with('colors')
            ->when($data->colors, function ($query) use ($data) {
                $query->whereHas('colors', function ($query) use ($data) {
                    $query->whereIn('colors.id', $data->colors);
                });
            })
            ->when($data->category, function ($query) use ($data) {
                $query->whereCategoryId($data->category);
            })
            ->where('price', '>=', $data->priceMin)
            ->where('price', '<=', $data->priceMax)
            ->paginate();
    }
}

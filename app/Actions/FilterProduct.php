<?php

namespace App\Actions;

use App\DTO\FilterProductDTO;
use App\Models\Product;
use MeiliSearch\Endpoints\Indexes;

class FilterProduct
{
    public function handle(FilterProductDTO $data)
    {
        return Product::search(
            '',
//            function(Indexes $meiliSearch, string $query, array $options) use ($data) {
//                $options['sort'] = ['id:asc'];
//
//                return $meiliSearch->search($query, $options);
//            }
        )
//            ->query()
//            ->with('colors')
//            ->when($data->colors, function ($query) use ($data) {
//                $query->whereHas('colors', function ($query) use ($data) {
//                    $query->whereIn('colors.id', $data->colors);
//                });
//            })
//            ->when($data->category, function ($query) use ($data) {
//                $query->whereCategoryId($data->category);
//            })
//            ->where('price', '>=', $data->priceMin)
//            ->where('price', '<=', $data->priceMax)
            ->paginate();
    }
}

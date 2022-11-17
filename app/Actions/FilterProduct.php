<?php

namespace App\Actions;

use App\DTO\FilterProductDTO;
use App\Models\Product;
use MeiliSearch\Endpoints\Indexes;

class FilterProduct
{
    public function handle(FilterProductDTO $data)
    {
        return Product::search('', function(Indexes $meiliSearch, string $query, array $options) use ($data){
            $options['sort'] = ['id:asc'];
            $options['filter'] = 'price >= ' . $data->priceMin . ' AND price <= ' . $data->priceMax;

            if($data->category) {
                $options['filter'] .= ' AND category = ' . $data->category;
            }

            if($data->colors) {
                $options['filter'] .= ' AND (';

                $colorFilter = [];
                foreach($data->colors as $color) {
                    $colorFilter[] = 'colors = ' . $color;
                }

                $options['filter'] .= implode(' OR ', $colorFilter) .  ') ';
            }

            return $meiliSearch->search( $query, $options );
        })
            ->paginate();
//        return Product::with('colors')
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
//            ->paginate();
    }
}

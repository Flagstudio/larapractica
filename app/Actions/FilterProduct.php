<?php

namespace App\Actions;

use App\DTO\FilteredProductDTO;
use App\DTO\FilterProductDTO;
use App\Models\Product;
use MeiliSearch\Endpoints\Indexes;

class FilterProduct
{
    private const DEFAULT_SORT = ['id:asc'];

    private const FACETS_DISTRIBUTION = [
        'colors',
    ];

    public function handle(FilterProductDTO $data): FilteredProductDTO
    {
        $searchResult = Product::search(
            '',
            function(Indexes $meiliSearch, string $query, array $options) use ($data) {
                $options['sort'] = self::DEFAULT_SORT;
                $options['facetsDistribution'] = self::FACETS_DISTRIBUTION;

                $options = $this->castPriceFilter($options, $data);
                $options = $this->castCategoryFilter($options, $data);
                $options = $this->castColorsFilter($options, $data);

                return $meiliSearch->search($query, $options);
            })
            ->paginateRaw()
            ->items();

        $products = Product::with('colors.pivot.media')
            ->find(
                array_column(
                    $searchResult['hits'],
                    'id',
                ),
            );

        $facets = $searchResult['facetsDistribution'];

        return new FilteredProductDTO(
            products: $products,
            facets: $facets,
        );
    }

//    public function handle(FilterProductDTO $data)
//    {
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
//            ->oldest('id')
//            ->paginate();
//    }

    private function castPriceFilter(array $options, FilterProductDTO $data): array
    {
        $options['filter'][] = 'price >= ' . $data->priceMin;
        $options['filter'][] = 'price <= ' . $data->priceMax;

        return $options;
    }

    private function castCategoryFilter(array $options, FilterProductDTO $data): array
    {
        if($data->category) {
            $options['filter'][] = 'category = ' . $data->category;
        }

        return $options;
    }

    private function castColorsFilter(array $options, FilterProductDTO $data): array
    {
        if($data->colors) {
            $options['filter'][] = collect($data->colors)->map(
                fn ($color) => 'colors = ' . $color,
            )->toArray();
        }

        return $options;
    }
}

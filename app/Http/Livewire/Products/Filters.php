<?php

namespace App\Http\Livewire\Products;

use App\Actions\FilterProduct;
use App\DTO\FilterProductDTO;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Filters extends Component
{
    public int $category = 0;

    public int $priceMin = 100;

    public int $priceMax = 5000;

    public array $colors = [];

    public Collection $categoriesList;

    public Collection $colorsList;

    public function mount(): void
    {
        $this->colorsList = Color::has('products')->get();
        $this->categoriesList = Category::has('products')->get();
        $this->priceMin = Product::oldest('price')->first()->price;
        $this->priceMax = Product::latest('price')->first()->price;
    }

    public function render(FilterProduct $action): View
    {
        $filteredProduct = $action->handle(
            new FilterProductDTO(
                colors: $this->colors,
                category: $this->category,
                priceMin: $this->priceMin,
                priceMax: $this->priceMax,
            ),
        );

        $products = $filteredProduct->products;

        $facetColors = $filteredProduct->facets['colors'] ?? [];
        $this->colorsList->each(fn ($color) => $color->facet = $facetColors[$color->id]);

        return view(
            'livewire.products.filters',
            compact(
                'products',
                'facetColors',
            ),
        );
    }
}

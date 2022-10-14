<?php

namespace App\Http\Livewire\Products;

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

    public function render(): View
    {
        $products = Product::with('media', 'colors')
            ->when($this->colors, function ($query) {
                $query->whereHas('colors', function ($query) {
                    $query->whereIn('id', $this->colors);
                });
            })
            ->when($this->category, function ($query) {
                $query->whereCategoryId($this->category);
            })
            ->where('price', '>=', $this->priceMin)
            ->where('price', '<=', $this->priceMax)
            ->get();

        return view(
            'livewire.products.filters',
            compact(
                'products',
            ),
        );
    }
}

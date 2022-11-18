<?php

namespace App\Http\Livewire\Products;

use App\Models\ColorProduct;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class Card extends Component
{
    public Product $product;

    public string $viewImage;

    public array $colorsList = [];

    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->colorsList = $product->colors->pluck('id')->toArray();
        $this->viewImage = $product->colors
            ->first()
            ?->pivot
            ->getFirstMediaUrl(ColorProduct::MEDIA_IMAGES)
            ?? '';
    }

    public function render(): View
    {
        return view('livewire.products.card');
    }

    public function chooseColor(int $id): void
    {
        $this->viewImage = $this->product->colors()
            ->find($id)
            ?->pivot
            ->getFirstMediaUrl(ColorProduct::MEDIA_IMAGES)
            ?? '';
    }
}

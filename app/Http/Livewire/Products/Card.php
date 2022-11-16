<?php

namespace App\Http\Livewire\Products;

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
        dd($product);
        $this->product = $product;
        $this->colorsList = $product->colors->pluck('id')->toArray();
        $this->viewImage = $product->getFirstMediaUrl('images');
    }

    public function render(): View
    {
        return view('livewire.products.card');
    }

    public function chooseColor(int $id): void
    {
        $this->viewImage = $this->product->getMedia('images')
            ->slice(array_flip($this->colorsList)[$id])
            ->first()
            ->getUrl();
    }
}

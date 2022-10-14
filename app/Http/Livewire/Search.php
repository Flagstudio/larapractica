<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public string $query = '';

    public function render(): View
    {
        $products = $this->query !== ''
            ? Product::search($this->query)->get()
            : [];

        return view(
            'livewire.search',
            compact(
                'products',
            ),
        );
    }
}

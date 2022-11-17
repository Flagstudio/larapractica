<?php

namespace App\Http\Livewire;

use App\Actions\SearchProduct;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public string $query = '';

    public function render(SearchProduct $action): View
    {
        $products = $action->handle($this->query);

        return view(
            'livewire.search',
            compact(
                'products',
            ),
        );
    }
}

<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public string $query = '';

    public array $results = [];

    public string $test = '123';

    public function updatedQuery(): void
    {
        $this->results = [1, 2, 3, rand(0, 10)];
    }

    public function render(): View
    {
        return view('livewire.search');
    }
}

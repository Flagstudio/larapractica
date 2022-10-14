<?php

namespace App\Http\Livewire\Cart;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class Mini extends Component
{
    public int $productsCount = 0;

    protected $listeners = ['addToCart'];

    public function mount()
    {
        $this->productsCount = count(Session::get('productsCount', []));
    }

    public function render(): View
    {
        return view('livewire.cart.mini');
    }

    public function addToCart(int $id)
    {
        $this->productsCount++;

        Session::push('productsCount', $id);
    }
}

<?php

namespace App\Http\Controllers;

use App\ViewModels\CartPageViewModel;
use Illuminate\View\View;
use Spatie\ViewModels\ViewModel;

class CartController extends Controller
{
    public function index(CartPageViewModel $viewModel): View|ViewModel
    {
        return $viewModel;
    }
}

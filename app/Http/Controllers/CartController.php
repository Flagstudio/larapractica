<?php

namespace App\Http\Controllers;

use App\ViewModels\CartPageViewModel;
use Illuminate\Http\JsonResponse;
use Spatie\ViewModels\ViewModel;

class CartController extends Controller
{
    public function index(CartPageViewModel $viewModel): ViewModel|JsonResponse
    {
        return $viewModel;
    }
}

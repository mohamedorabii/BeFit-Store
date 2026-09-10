<?php

namespace App\Http\Controllers;

use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(
        protected ShopService $shopService,
    ) {}

    public function index(Request $request)
    {
        $categories = $this->shopService->getFilterCategories();
        $sizes = $this->shopService->getFilterSizes();
        $colors = $this->shopService->getFilterColors();
        $products = $this->shopService->getFilteredProducts($request);

        return view('shop', compact('products', 'categories', 'sizes', 'colors'));
    }
}
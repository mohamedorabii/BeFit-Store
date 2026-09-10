<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    public function __construct(
        protected HomeService $homeService,
    ) {}

    public function index()
    {
        $categories = $this->homeService->getFeaturedCategories();
        $featuredProducts = $this->homeService->getFeaturedProducts();

        return view('home', compact('categories', 'featuredProducts'));
    }
}
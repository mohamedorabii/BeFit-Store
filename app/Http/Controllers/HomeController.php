<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the BeFit homepage.
     *
     * TODO: once CategoryService / ProductService exist (same pattern as
     * OrabyStore), replace these arrays with real calls, e.g.:
     *   $categories = $this->categoryService->topLevel();
     *   $featuredProducts = $this->productService->featured();
     */
    public function index()
    {
        $categories = [
            [
                'title' => 'Men',
                'url' => '/shop?category=men',
                'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Women',
                'url' => '/shop?category=women',
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Shoes',
                'url' => '/shop?category=shoes',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop',
            ],
        ];

        $featuredProducts = [
            [
                'title' => 'Sport T-Shirt',
                'description' => 'Breathable fabric for everyday training.',
                'price' => 39,
                'old_price' => 55,
                'badge' => 'NEW',
                'url' => '/product/sport-t-shirt',
                'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Running Shoes',
                'description' => 'Comfort & performance combined.',
                'price' => 79,
                'old_price' => 110,
                'badge' => 'HOT',
                'url' => '/product/running-shoes',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Training Shorts',
                'description' => 'Flexible fit with premium comfort.',
                'price' => 29,
                'old_price' => 45,
                'badge' => 'SALE',
                'url' => '/product/training-shorts',
                'image' => 'https://images.unsplash.com/photo-1506629905607-d9a31768d35f?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => "Women's Set",
                'description' => 'Premium gym collection.',
                'price' => 65,
                'old_price' => 90,
                'badge' => '-25%',
                'url' => '/product/womens-set',
                'image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=900&auto=format&fit=crop',
            ],
        ];

        return view('home', compact('categories', 'featuredProducts'));
    }
}

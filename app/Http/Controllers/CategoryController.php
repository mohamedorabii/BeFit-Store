<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    /**
     * Show all categories.
     *
     * TODO: once CategoryService exists (same pattern as OrabyStore),
     * replace this with a real call, e.g.:
     *   $categories = $this->categoryService->allWithCounts();
     */
    public function index()
    {
        $categories = [
            [
                'title' => 'Men',
                'url' => '/shop?category=men',
                'count' => 24,
                'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Women',
                'url' => '/shop?category=women',
                'count' => 31,
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Shoes',
                'url' => '/shop?category=shoes',
                'count' => 12,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Accessories',
                'url' => '/shop?category=accessories',
                'count' => 9,
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Outerwear',
                'url' => '/shop?category=outerwear',
                'count' => 14,
                'image' => 'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'New Arrivals',
                'url' => '/shop?category=new',
                'count' => 18,
                'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=900&auto=format&fit=crop',
            ],
        ];

        return view('categories', compact('categories'));
    }
}

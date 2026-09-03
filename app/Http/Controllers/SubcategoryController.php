<?php

namespace App\Http\Controllers;

class SubcategoryController extends Controller
{
    /**
     * Show all subcategories.
     *
     * TODO: once SubcategoryService exists (same pattern as CategoryController),
     * replace this with a real call, e.g.:
     *   $subcategories = $this->subcategoryService->allWithCounts();
     */
    public function index()
    {
        $subcategories = [
            [
                'title' => 'T-Shirts',
                'url' => '/shop?subcategory=t-shirts',
                'count' => 15,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Hoodies',
                'url' => '/shop?subcategory=hoodies',
                'count' => 9,
                'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Leggings',
                'url' => '/shop?subcategory=leggings',
                'count' => 11,
                'image' => 'https://images.unsplash.com/photo-1506629082955-511b1aa562c8?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Sneakers',
                'url' => '/shop?subcategory=sneakers',
                'count' => 7,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Bags',
                'url' => '/shop?subcategory=bags',
                'count' => 6,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'title' => 'Jackets',
                'url' => '/shop?subcategory=jackets',
                'count' => 8,
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=900&auto=format&fit=crop',
            ],
        ];

        return view('subcategories', compact('subcategories'));
    }
}
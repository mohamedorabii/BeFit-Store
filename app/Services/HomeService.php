<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class HomeService
{
    public function getFeaturedCategories(int $limit = 3)
    {
        return Category::query()
            ->where('status', 1)
            ->orderBy('sort_order')
            ->limit($limit)
            ->get()
            ->map(fn (Category $category) => [
                'title' => $category->name_en,
                'url' => '/shop?category=' . $category->slug,
                'image' => $category->image
                    ? asset('storage/' . $category->image)
                    : asset('storage/categories/default.png'),
            ]);
    }

    public function getFeaturedProducts(int $limit = 4)
    {
        return Product::query()
            ->with('primaryImage')
            ->where('status', 1)
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (Product $product) => [
                'title' => $product->name_en,
                'description' => $product->description_en,
                'price' => $product->price,
                'old_price' => $product->old_price,
                'badge' => $product->badge,
                'url' => '/product/' . $product->slug,
                'image' => $product->primaryImage?->image
                    ? asset('storage/' . $product->primaryImage->image)
                    : asset('storage/products/default.png'),
            ]);
    }
}
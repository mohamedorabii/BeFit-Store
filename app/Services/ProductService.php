<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{
    public function findBySlug(string $slug): Product
    {
        return Product::with([
            'images' => fn($query) => $query->orderBy('sort_order'),
            'variants.color',
            'variants.size',
            'category',
        ])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();
    }

    public function getSizes(Product $product): Collection
    {
        return $product->variants->pluck('size')->unique('id')->values();
    }

    public function getColors(Product $product): Collection
    {
        return $product->variants->pluck('color')->unique('id')->values();
    }

    public function getRelated(Product $product, int $limit = 4): Collection
    {
        return Product::with('primaryImage')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->take($limit)
            ->get();
    }

    public function getVariantsJson(Product $product): Collection
    {
        return $product->variants->map(fn($v) => [
            'id' => $v->id,
            'color_id' => $v->color_id,
            'size_id' => $v->size_id,
            'stock' => $v->stock,
            'sku' => $v->sku,
        ])->values();
    }


    public function search(string $query, int $limit = 6): Collection
    {
        return Product::query()
            ->where('status', true)
            ->where(function ($q) use ($query) {
                $q->where('name_en', 'like', "%{$query}%")
                    ->orWhere('name_ar', 'like', "%{$query}%");
            })
            ->with('primaryImage')
            ->limit($limit)
            ->get();
    }
}

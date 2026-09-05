<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::with([
            'images' => fn ($query) => $query->orderBy('sort_order'),
            'variants.color',
            'variants.size',
            'category',
        ])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $sizes = $product->variants->pluck('size')->unique('id')->values();
        $colors = $product->variants->pluck('color')->unique('id')->values();

        $relatedProducts = Product::with('primaryImage')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->take(4)
            ->get();

        $variantsJson = $product->variants->map(fn ($v) => [
            'id' => $v->id,
            'color_id' => $v->color_id,
            'size_id' => $v->size_id,
            'stock' => $v->stock,
            'sku' => $v->sku,
        ])->values();

        return view('product', compact('product', 'sizes', 'colors', 'relatedProducts', 'variantsJson'));
    }
}
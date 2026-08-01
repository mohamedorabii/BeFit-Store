<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    /**
     * Show a single product page.
     *
     * TODO: once ProductService exists (same pattern as OrabyStore), replace
     * this with a real lookup, e.g.:
     *   $product = $this->productService->findBySlug($slug);
     *   $relatedProducts = $this->productService->relatedTo($product);
     */
    public function show(string $slug)
    {
        $product = [
            'slug' => $slug,
            'sku' => 'BF-' . strtoupper(substr(md5($slug), 0, 6)),
            'title' => 'Performance Training Tee',
            'category' => 'Men / T-Shirts',
            'price' => 39,
            'old_price' => 55,
            'badge' => 'NEW',
            'reviews_count' => 24,
            'description' => 'Lightweight, breathable fabric built for high-output training days — moves with you, dries fast, stays comfortable from warm-up to cool-down.',
            'long_description' => 'The Performance Training Tee is cut from a four-way stretch, moisture-wicking blend designed to keep you cool and unrestricted through every rep. Flatlock seams reduce chafing on long sessions, and a slightly longer hem keeps it in place during dynamic movement. Machine washable, colorfast, and built to hold its shape wash after wash.',
            'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1200&auto=format&fit=crop',
            'gallery' => [
                'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1503341504253-dff4815485f1?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=1200&auto=format&fit=crop',
            ],
            'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
            'colors' => [
                ['name' => 'Navy', 'hex' => '#1B2A4A'],
                ['name' => 'Black', 'hex' => '#16140F'],
                ['name' => 'Gray', 'hex' => '#9CA3AF'],
            ],
        ];

        $relatedProducts = [
            ['title' => 'Running Shoes', 'description' => 'Comfort & performance combined.', 'price' => 79, 'old_price' => 110, 'badge' => 'HOT', 'url' => '/product/running-shoes', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Training Shorts', 'description' => 'Flexible fit with premium comfort.', 'price' => 29, 'old_price' => 45, 'badge' => 'SALE', 'url' => '/product/training-shorts', 'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Performance Hoodie', 'description' => 'Warm, light, and built to move.', 'price' => 59, 'old_price' => null, 'badge' => null, 'url' => '/product/performance-hoodie', 'image' => 'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Tank Top', 'description' => 'Lightweight layer for warm-weather sessions.', 'price' => 25, 'old_price' => 35, 'badge' => 'SALE', 'url' => '/product/tank-top', 'image' => 'https://images.unsplash.com/photo-1571945153237-4929e783af4a?q=80&w=900&auto=format&fit=crop'],
        ];

        return view('product', compact('product', 'relatedProducts'));
    }
}

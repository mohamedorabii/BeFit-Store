<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ShopController extends Controller
{
    /**
     * Show the shop listing page.
     *
     * TODO: once ProductService / CategoryService exist (same pattern as
     * OrabyStore), replace this with real, filterable, paginated queries, e.g.:
     *   $products = $this->productService->paginate($request->validated());
     *   $categories = $this->categoryService->withCounts();
     */
    public function index(Request $request)
    {
        $categories = [
            ['slug' => 'men', 'title' => 'Men', 'count' => 24],
            ['slug' => 'women', 'title' => 'Women', 'count' => 31],
            ['slug' => 'shoes', 'title' => 'Shoes', 'count' => 12],
            ['slug' => 'accessories', 'title' => 'Accessories', 'count' => 9],
        ];

        $allProducts = [
            ['title' => 'Sport T-Shirt', 'description' => 'Breathable fabric for everyday training.', 'price' => 39, 'old_price' => 55, 'badge' => 'NEW', 'url' => '/product/sport-t-shirt', 'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Running Shoes', 'description' => 'Comfort & performance combined.', 'price' => 79, 'old_price' => 110, 'badge' => 'HOT', 'url' => '/product/running-shoes', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Training Shorts', 'description' => 'Flexible fit with premium comfort.', 'price' => 29, 'old_price' => 45, 'badge' => 'SALE', 'url' => '/product/training-shorts', 'image' => 'https://images.unsplash.com/photo-1506629905607-d9a31768d35f?q=80&w=900&auto=format&fit=crop'],
            ['title' => "Women's Set", 'description' => 'Premium gym collection.', 'price' => 65, 'old_price' => 90, 'badge' => '-25%', 'url' => '/product/womens-set', 'image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Performance Hoodie', 'description' => 'Warm, light, and built to move.', 'price' => 59, 'old_price' => null, 'badge' => null, 'url' => '/product/performance-hoodie', 'image' => 'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Compression Leggings', 'description' => 'Second-skin support for high-output days.', 'price' => 45, 'old_price' => 60, 'badge' => 'SALE', 'url' => '/product/compression-leggings', 'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Training Cap', 'description' => 'Sweat-wicking, adjustable fit.', 'price' => 19, 'old_price' => null, 'badge' => null, 'url' => '/product/training-cap', 'image' => 'https://images.unsplash.com/photo-1521369909029-2afed882baee?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Gym Duffel Bag', 'description' => 'Room for kit, shoes, and a change of clothes.', 'price' => 49, 'old_price' => null, 'badge' => 'NEW', 'url' => '/product/gym-duffel-bag', 'image' => 'https://images.unsplash.com/photo-1547949003-9792a18a2645?q=80&w=900&auto=format&fit=crop'],
            ['title' => 'Tank Top', 'description' => 'Lightweight layer for warm-weather sessions.', 'price' => 25, 'old_price' => 35, 'badge' => 'SALE', 'url' => '/product/tank-top', 'image' => 'https://images.unsplash.com/photo-1571945153237-4929e783af4a?q=80&w=900&auto=format&fit=crop'],
        ];

        $perPage = 6;
        $page = LengthAwarePaginator::resolveCurrentPage() ?: 1;
        $items = array_slice($allProducts, ($page - 1) * $perPage, $perPage);

        $products = new LengthAwarePaginator(
            $items,
            count($allProducts),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('shop', compact('products', 'categories'));
    }
}

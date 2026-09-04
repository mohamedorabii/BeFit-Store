<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', true)
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        $products = Product::with('primaryImage')
            ->where('status', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->query('category'));
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('shop', compact('products', 'categories'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', true)
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        $sizes = Size::where('status', true)->get();
        $colors = Color::where('status', true)->get();

        $sort = $request->query('sort', 'featured');

        $products = Product::with('primaryImage')
            ->where('status', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->whereIn('slug', (array) $request->query('category'));
                });
            })
            ->when($request->filled('subcategory'), function ($query) use ($request) {
                $query->whereHas('subcategory', function ($q) use ($request) {
                    $q->where('slug', $request->query('subcategory'));
                });
            })
            ->when($request->filled('size'), function ($query) use ($request) {
                $query->whereHas('variants', function ($q) use ($request) {
                    $q->whereHas('size', function ($sq) use ($request) {
                        $sq->whereIn('name_en', (array) $request->query('size'));
                    });
                });
            })
            ->when($request->filled('color'), function ($query) use ($request) {
                $query->whereHas('variants', function ($q) use ($request) {
                    $q->whereHas('color', function ($cq) use ($request) {
                        $cq->whereIn('name_en', (array) $request->query('color'));
                    });
                });
            })
            ->when($request->filled('price_min'), function ($query) use ($request) {
                $query->where('price', '>=', $request->query('price_min'));
            })
            ->when($request->filled('price_max'), function ($query) use ($request) {
                $query->where('price', '<=', $request->query('price_max'));
            })
            ->when($sort === 'price_asc', fn($query) => $query->orderBy('price', 'asc'))
            ->when($sort === 'price_desc', fn($query) => $query->orderBy('price', 'desc'))
            ->when($sort === 'newest', fn($query) => $query->latest())
            ->when($sort === 'featured', fn($query) => $query->orderBy('created_at'))
            ->paginate(6)
            ->withQueryString();

        return view('shop', compact('products', 'categories', 'sizes', 'colors'));
    }
}

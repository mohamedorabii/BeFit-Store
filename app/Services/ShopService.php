<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ShopService
{
    public function getFilterCategories(): Collection
    {
        return Category::where('status', true)
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();
    }

    public function getFilterSizes(): Collection
    {
        return Size::where('status', true)->get();
    }

    public function getFilterColors(): Collection
    {
        return Color::where('status', true)->get();
    }

    public function getFilteredProducts(Request $request): LengthAwarePaginator
    {
        $sort = $request->query('sort', 'featured');

        return Product::with('primaryImage')
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
            ->when($sort === 'price_asc', fn ($query) => $query->orderBy('price', 'asc'))
            ->when($sort === 'price_desc', fn ($query) => $query->orderBy('price', 'desc'))
            ->when($sort === 'newest', fn ($query) => $query->latest())
            ->when($sort === 'featured', fn ($query) => $query->orderBy('created_at'))
            ->paginate(6)
            ->withQueryString();
    }
}
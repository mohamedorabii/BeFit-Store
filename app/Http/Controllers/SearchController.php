<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function products(Request $request): JsonResponse
    {
        $query = trim((string) $request->query('q', ''));

        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }

        $results = $this->productService->search($query)->map(fn ($product) => [
            'name'  => $product->name_en,
            'price' => number_format($product->price, 0),
            'url'   => url('/product/' . $product->slug),
            'image' => $product->primary_image_url,
        ]);

        return response()->json($results);
    }
}
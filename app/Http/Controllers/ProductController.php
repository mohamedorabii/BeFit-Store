<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function show(string $slug)
    {
        $product = $this->productService->findBySlug($slug);

        $sizes = $this->productService->getSizes($product);
        $colors = $this->productService->getColors($product);
        $relatedProducts = $this->productService->getRelated($product);
        $variantsJson = $this->productService->getVariantsJson($product);

        return view('product', compact('product', 'sizes', 'colors', 'relatedProducts', 'variantsJson'));
    }
}
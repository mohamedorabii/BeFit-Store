<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', true)
            ->orderBy('sort_order')
            ->paginate(9);

        return view('categories', compact('categories'));
    }
}
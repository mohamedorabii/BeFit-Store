<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::where('status', true)
            ->orderBy('sort_order')
            ->paginate(9);

        return view('subcategories', compact('subcategories'));
    }
}
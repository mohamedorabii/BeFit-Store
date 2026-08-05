<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WishlistController extends Controller
{
    public function index()
    {
        $items = session('wishlist', []);

        return view('wishlist', compact('items'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'url' => 'nullable|string',
        ]);

        $wishlist = session('wishlist', []);
        $key = Str::slug($validated['title']);

        $wishlist[$key] = $validated;
        session(['wishlist' => $wishlist]);

        return back()->with('success', $validated['title'] . ' added to wishlist.');
    }

    public function remove(string $key)
    {
        $wishlist = session('wishlist', []);
        unset($wishlist[$key]);
        session(['wishlist' => $wishlist]);

        return back()->with('success', 'Item removed from wishlist.');
    }
}

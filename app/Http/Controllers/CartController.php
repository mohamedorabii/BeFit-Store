<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Show the cart page.
     *
     * TODO: once a real Cart model / CartService exists (same pattern as
     * OrabyStore's CartService), swap the session array below for it —
     * the view only needs $items (array) and $subtotal (number), so the
     * Blade file won't need to change.
     */
    public function index()
    {
        $items = session('cart', []);
        $subtotal = collect($items)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('cart', compact('items', 'subtotal'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'url' => 'nullable|string',
            'quantity' => 'nullable|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $cart = session('cart', []);

        // Same product + size + color combo bumps quantity instead of duplicating the row.
        $key = Str::slug($validated['title'] . '-' . ($validated['size'] ?? '') . '-' . ($validated['color'] ?? ''));

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $validated['quantity'] ?? 1;
        } else {
            $cart[$key] = [
                'title' => $validated['title'],
                'price' => $validated['price'],
                'image' => $validated['image'] ?? '',
                'url' => $validated['url'] ?? '#',
                'size' => $validated['size'] ?? null,
                'color' => $validated['color'] ?? null,
                'quantity' => $validated['quantity'] ?? 1,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', $validated['title'] . ' added to cart.');
    }

    public function updateQuantity(Request $request, string $key)
    {
        $validated = $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = session('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $validated['quantity'];
            session(['cart' => $cart]);
        }

        return back();
    }

    public function remove(string $key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item removed from cart.');
    }
}

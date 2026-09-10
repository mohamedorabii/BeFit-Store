<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistAddRequest;
use App\Services\WishlistService;

class WishlistController extends Controller
{
    public function __construct(protected WishlistService $wishlistService) {}

    public function index()
    {
        $items = $this->wishlistService->getItems();

        return view('wishlist', compact('items'));
    }

    public function add(WishlistAddRequest $request)
    {
        $item = $this->wishlistService->add($request->validated());

        return back()->with('success', $item['title'] . ' added to wishlist.');
    }

    public function remove(string $key)
    {
        $this->wishlistService->remove($key);

        return back()->with('success', 'Item removed from wishlist.');
    }
}
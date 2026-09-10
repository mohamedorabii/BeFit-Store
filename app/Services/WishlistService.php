<?php

namespace App\Services;

use Illuminate\Support\Str;

class WishlistService
{
    public function getItems(): array
    {
        return session('wishlist', []);
    }

    public function add(array $item): array
    {
        $wishlist = session('wishlist', []);
        $key = Str::slug($item['title']);

        $wishlist[$key] = $item;
        session(['wishlist' => $wishlist]);

        return $item;
    }

    public function remove(string $key): void
    {
        $wishlist = session('wishlist', []);
        unset($wishlist[$key]);
        session(['wishlist' => $wishlist]);
    }
}
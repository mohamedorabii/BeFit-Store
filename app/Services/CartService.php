<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService
{
    public function getIdentifier($userId = null, $sessionId = null): array
    {
        return $userId
            ? ['user_id' => $userId]
            : ['session_id' => $sessionId];
    }

    public function getCartItems(array $identifier)
    {
        return Cart::where($identifier)
            ->whereHas('product', function ($query) {
                $query->where('status', 1)
                    ->whereHas('category', function ($q) {
                        $q->where('status', 1);
                    });
            })
            ->with(['product.primaryImage', 'variant.color', 'variant.size'])
            ->get();
    }

    public function calculateTotal($cartItems): array
    {
        $total = $cartItems->sum(function ($item) {
            if (! $item->product) {
                return 0;
            }

            return $item->unit_price * $item->quantity;
        });

        return compact('total');
    }

    public function addToCart(array $identifier, int $productId, int $quantity, int $variantId): bool
    {
        $product = Product::where('status', 1)
            ->with(['variants'])
            ->whereHas('category', fn($q) => $q->where('status', 1))
            ->find($productId);

        if (! $product) {
            return false;
        }

        $variant = $product->variants->firstWhere('id', $variantId);

        if (! $variant) {
            return false;
        }

        $cartItem = Cart::where($identifier)
            ->where('product_id', $productId)
            ->where('variant_id', $variantId)
            ->first();

        $newQuantity = ($cartItem?->quantity ?? 0) + $quantity;

        if ($newQuantity > $variant->stock) {
            return false;
        }

        if ($cartItem) {
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                ...$identifier,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
            ]);
        }

        return true;
    }

    public function updateCart(Cart $cart, int $quantity, ?int $userId, ?string $sessionId = null): bool
    {
        $cart->loadMissing(['product', 'variant']);

        if ($userId === null) {
            if ($cart->session_id !== $sessionId) {
                return false;
            }
        } elseif ($cart->user_id !== $userId) {
            return false;
        }

        if (! $cart->product || $quantity > $cart->available_stock) {
            return false;
        }

        $cart->update(['quantity' => $quantity]);

        return true;
    }

    public function removeFromCart(Cart $cart, ?int $userId): bool
    {
        if ($userId === null) {
            $cart->delete();

            return true;
        }

        if ($cart->user_id !== $userId) {
            return false;
        }

        $cart->delete();

        return true;
    }

    public function clearCart(array $identifier): void
    {
        Cart::where($identifier)->delete();
    }
    public function mergeCart(string $sessionId, int $userId): void
    {
        $guestItems = Cart::where('session_id', $sessionId)->get();

        foreach ($guestItems as $guestItem) {
            $existing = Cart::where('user_id', $userId)
                ->where('product_id', $guestItem->product_id)
                ->where('variant_id', $guestItem->variant_id)
                ->first();

            if ($existing) {
                $existing->update(['quantity' => $existing->quantity + $guestItem->quantity]);
                $guestItem->delete();
            } else {
                $guestItem->update([
                    'user_id' => $userId,
                    'session_id' => null,
                ]);
            }
        }
    }
}

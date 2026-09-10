<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\ShippingOption;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function createFromCart(
        array $validated,
        Collection $cartItems,
        ShippingOption $shippingOption,
        ?int $userId,
        float $subtotal,
    ): Order {
        $shipping = $shippingOption->price;
        $total = $subtotal + $shipping;

        return DB::transaction(function () use ($validated, $cartItems, $shipping, $total, $userId) {

            foreach ($cartItems as $item) {
                $variant = ProductVariant::lockForUpdate()->find($item->variant_id);

                if (! $variant || $variant->stock < $item->quantity) {
                    throw new \Exception(
                        "Sorry, only {$variant?->stock} units available for one of the items in your cart."
                    );
                }
            }

            $order = Order::create([
                'user_id' => $userId,
                'order_number' => 'BF-' . strtoupper(uniqid()),
                'status' => 'pending',
                'shipping_price' => $shipping,
                'name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'governorate' => $validated['governorate'],
                'total_price' => $total,
            ]);

            foreach ($cartItems as $item) {
                $variant = ProductVariant::lockForUpdate()->find($item->variant_id);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->unit_price,
                    'total_price' => $item->unit_price * $item->quantity,
                    'color_name_en' => $item->variant->color->name_en ?? null,
                    'color_name_ar' => $item->variant->color->name_ar ?? null,
                    'size_name_en' => $item->variant->size->name_en ?? null,
                    'size_name_ar' => $item->variant->size->name_ar ?? null,
                    'variant_sku' => $item->variant->sku ?? null,
                ]);

                $variant->decrement('stock', $item->quantity);
            }

            return $order;
        });
    }
}
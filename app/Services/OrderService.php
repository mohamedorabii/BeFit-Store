<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getUserOrders(int $userId)
    {
        return Order::where('user_id', $userId)
            ->with('items.product')
            ->latest()
            ->get();
    }

    public function cancel(Order $order, int $userId): bool
    {
        if ($order->user_id !== $userId) {
            return false;
        }

        if ($order->status !== 'pending') {
            return false;
        }

        DB::transaction(function () use ($order) {
            $order->loadMissing('items.variant');

            foreach ($order->items as $item) {
                if ($item->variant) {
                    $item->variant->increment('stock', $item->quantity);
                }
            }

            $order->update(['status' => 'cancelled']);
        });

        return true;
    }
}
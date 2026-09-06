<?php

namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Auth\Events\Login;

class MergeGuestCart
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionId = request()->cookie(config('session.cookie'));

        if (! $sessionId) {
            return;
        }

        $guestItems = Cart::whereNull('user_id')
            ->where('session_id', $sessionId)
            ->get();

        foreach ($guestItems as $guestItem) {
            $userItem = Cart::where('user_id', $user->id)
                ->where('product_id', $guestItem->product_id)
                ->where('variant_id', $guestItem->variant_id)
                ->first();

            if ($userItem) {
                $maxStock = $guestItem->variant->stock ?? 0;

                $userItem->update([
                    'quantity' => min($userItem->quantity + $guestItem->quantity, $maxStock),
                ]);

                $guestItem->delete();
                continue;
            }

            $guestItem->update([
                'user_id' => $user->id,
                'session_id' => null,
            ]);
        }
    }
}
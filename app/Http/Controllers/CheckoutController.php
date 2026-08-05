<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = session('cart', []);

        if (empty($items)) {
            return redirect('/cart');
        }

        $subtotal = collect($items)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shipping = $subtotal >= 100 ? 0 : 8;
        $total = $subtotal + $shipping;

        return view('checkout', compact('items', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Place the order.
     *
     * TODO: once OrderService / Order model exist (same pattern as
     * OrabyStore's CheckoutService), replace this with a real order
     * creation + payment step, e.g.:
     *   $order = $this->checkoutService->place($validated, session('cart'));
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:120',
            'payment_method' => 'required|in:cod,card',
        ]);

        $items = session('cart', []);

        if (empty($items)) {
            return redirect('/cart');
        }

        $orderNumber = 'BF-' . strtoupper(uniqid());

        session()->forget('cart');

        return redirect('/order-confirmation')->with([
            'order_number' => $orderNumber,
            'customer_name' => $validated['full_name'],
        ]);
    }

    public function confirmation()
    {
        if (! session('order_number')) {
            return redirect('/');
        }

        return view('order-confirmation');
    }
}

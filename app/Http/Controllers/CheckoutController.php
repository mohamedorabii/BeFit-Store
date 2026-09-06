<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function __construct(protected CartService $cartService) {}

    private function identifier(): array
    {
        return $this->cartService->getIdentifier(
            Auth::check() ? Auth::id() : null,
            session()->getId()
        );
    }

    public function index()
    {
        $cartItems = $this->cartService->getCartItems($this->identifier());

        if ($cartItems->isEmpty()) {
            return redirect('/cart');
        }

        $subtotal = $this->cartService->calculateTotal($cartItems)['total'];
        $shipping = $subtotal >= 100 ? 0 : 8;
        $total = $subtotal + $shipping;

        return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Place the order.
     *
     * TODO: once OrderService / Order model exist (same pattern as
     * OrabyStore's CheckoutService), replace this with a real order
     * creation + payment step.
     */


    public function store(CheckoutRequest $request)
    {
        $validated = $request->validated();

        $cartItems = $this->cartService->getCartItems($this->identifier());

        if ($cartItems->isEmpty()) {
            return redirect('/cart');
        }

        $orderNumber = 'BF-' . strtoupper(uniqid());

        $this->cartService->clearCart($this->identifier());

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

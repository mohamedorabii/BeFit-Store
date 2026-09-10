<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\ShippingOption;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected CheckoutService $checkoutService,
    ) {}

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
        $shippingOptions = ShippingOption::orderBy('governorate')->get();

        return view('checkout', compact('cartItems', 'subtotal', 'shippingOptions'));
    }


    public function store(CheckoutRequest $request)
    {
        $validated = $request->validated();

        $cartItems = $this->cartService->getCartItems($this->identifier());

        if ($cartItems->isEmpty()) {
            return redirect('/cart');
        }

        $shippingOption = ShippingOption::where('governorate', $validated['governorate'])->first();

        if (! $shippingOption) {
            return back()->withErrors(['governorate' => 'Please select a valid governorate.']);
        }

        $subtotal = $this->cartService->calculateTotal($cartItems)['total'];

        try {
            $order = $this->checkoutService->createFromCart(
                $validated,
                $cartItems,
                $shippingOption,
                Auth::id(),
                $subtotal,
            );
        } catch (\Exception $e) {
            return redirect('/cart')->with('error', $e->getMessage());
        }

        $this->cartService->clearCart($this->identifier());

        return redirect()->route('checkout.confirmation', $order->id);
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items');

        return view('order-confirmation', compact('order'));
    }
}

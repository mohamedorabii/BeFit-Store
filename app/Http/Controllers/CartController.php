<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
        $totals = $this->cartService->calculateTotal($cartItems);

        return view('cart', array_merge(compact('cartItems'), $totals));
    }

    public function add(AddToCartRequest $request)
    {
        $added = $this->cartService->addToCart(
            $this->identifier(),
            $request->product_id,
            $request->quantity ?? 1,
            $request->variant_id
        );

        if (! $added) {
            return back()->withErrors([
                'quantity' => 'The requested quantity exceeds the available stock.',
            ]);
        }

        return redirect()->route('cart')
            ->with('success', 'Product added to cart successfully.');
    }

    public function updateQuantity(UpdateCartRequest $request, Cart $cart)
    {
        $updated = $this->cartService->updateCart(
            $cart,
            $request->quantity,
            Auth::id(),
            session()->getId()
        );

        if (! $updated) {
            return back()->withErrors([
                'quantity' => 'The requested quantity is not available.',
            ]);
        }

        return redirect()->route('cart')
            ->with('success', 'Cart updated successfully.');
    }

    public function remove(Cart $cart)
    {
        $this->cartService->removeFromCart($cart, Auth::id());

        return redirect()->route('cart')->with('success', 'Product removed from cart successfully.');
    }
}
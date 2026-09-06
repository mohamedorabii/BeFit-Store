<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingOption;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $shipping = $shippingOption->price;
        $total = $subtotal + $shipping;

        $order = DB::transaction(function () use ($validated, $cartItems, $shipping, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
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
            }

            $this->cartService->clearCart($this->identifier());

            return $order;
        });

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
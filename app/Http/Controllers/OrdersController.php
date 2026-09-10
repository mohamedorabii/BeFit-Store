<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    public function index(): View
    {
        $orders = $this->orderService->getUserOrders(Auth::id());

        return view('orders', compact('orders'));
    }

    public function cancel(Order $order): RedirectResponse
    {
        $cancelled = $this->orderService->cancel($order, Auth::id());

        if (! $cancelled) {
            return back()->with('error', 'This order can no longer be cancelled.');
        }

        return back()->with('success', 'Order cancelled successfully.');
    }
}
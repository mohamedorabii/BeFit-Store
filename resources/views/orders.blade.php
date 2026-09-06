@extends('layouts.app')

@section('title', 'My Orders — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / My Orders
            </div>
            <h1>My Orders</h1>
            <p>Track your orders and view all purchased products.</p>
        </div>
    </div>

    <div class="container orders-page">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" style="background:#fdecea;color:#c0392b;border-color:#f5c6cb;">{{ session('error') }}</div>
        @endif

        @if ($orders->isEmpty())

            <div class="empty-cart">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 8l-9-5-9 5 9 5 9-5z"/><path d="M3 8v8l9 5 9-5V8"/>
                </svg>
                <h3>No Orders Yet</h3>
                <p>Once you place your first order, it will appear here.</p>
                <a href="{{ url('/shop') }}" class="btn-main">Shop Now</a>
            </div>

        @else

            <div class="row g-4">
                @foreach ($orders as $order)
                    @php
                        $statusColors = [
                            'pending' => '#f59e0b',
                            'shipped' => '#3b82f6',
                            'delivered' => '#16a34a',
                            'cancelled' => '#ef4444',
                        ];
                        $statusColor = $statusColors[$order->status] ?? '#6b7280';
                    @endphp

                    <div class="col-lg-6">
                        <div class="order-card">

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">Order #{{ $order->order_number }}</h5>
                                    <small class="text-muted">{{ $order->created_at->format('d M Y - h:i A') }}</small>
                                </div>
                                <span class="order-status-badge" style="background:{{ $statusColor }}1a;color:{{ $statusColor }};">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <hr>

                            <p class="mb-1"><strong>Name:</strong> {{ $order->name }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                            <p class="mb-0"><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->governorate }}</p>

                            <hr>

                            <div class="row text-center mb-3">
                                <div class="col-4">
                                    <small class="text-muted d-block">Products</small>
                                    <strong>{{ $order->items->count() }}</strong>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted d-block">Shipping</small>
                                    <strong>${{ number_format($order->shipping_price, 2) }}</strong>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted d-block">Total</small>
                                    <strong style="color:#16a34a;">${{ number_format($order->total_price, 2) }}</strong>
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3">Order Items</h6>
                            <ul class="order-items-list mb-3">
                                @foreach ($order->items as $item)
                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong>{{ optional($item->product)->name_en ?? 'Product Removed' }}</strong>
                                                @if ($item->size_name_en || $item->color_name_en)
                                                    <br><small class="text-muted">{{ $item->size_name_en }} / {{ $item->color_name_en }}</small>
                                                @endif
                                                <br><small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                            </div>
                                            <div class="text-end">
                                                <strong style="color:#16a34a;">${{ number_format($item->total_price, 2) }}</strong>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            @if ($order->status === 'pending')
                                <a href="{{ route('checkout.confirmation', $order) }}" class="btn-main d-block text-center mb-2">Complete Payment</a>

                                <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-outline-cancel d-block w-100">Cancel Order</button>
                                </form>
                            @elseif ($order->status === 'cancelled')
                                <button class="btn-main d-block w-100" disabled style="background:#ef4444;opacity:0.6;">Order Cancelled</button>
                            @elseif ($order->status === 'delivered')
                                <button class="btn-main d-block w-100" disabled style="background:#16a34a;opacity:0.6;">Delivered</button>
                            @elseif ($order->status === 'shipped')
                                <button class="btn-main d-block w-100" disabled style="background:#3b82f6;opacity:0.6;">Shipped</button>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>

        @endif

    </div>

    <style>
        .order-card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; height: 100%; background: #fff; }
        .order-status-badge { padding: 4px 12px; border-radius: 999px; font-size: 0.8rem; font-weight: 600; }
        .order-items-list { list-style: none; padding: 0; margin: 0; }
        .order-items-list li { border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; margin-bottom: 8px; }
        .btn-outline-cancel { background: transparent; border: 1px solid #ef4444; color: #ef4444; border-radius: 8px; padding: 10px; text-align: center; cursor: pointer; }
        .btn-outline-cancel:hover { background: #ef4444; color: #fff; }
    </style>

@endsection
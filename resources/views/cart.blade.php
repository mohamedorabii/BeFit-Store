@extends('layouts.app')

@section('title', 'Your Cart — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / Cart
            </div>
            <h1>Your Cart</h1>
            <p>{{ count($items) }} {{ count($items) === 1 ? 'item' : 'items' }}</p>
        </div>
    </div>

    <div class="container cart-page">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (empty($items))

            <div class="empty-cart">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 2l1.5 5h9L18 2"/><path d="M3.5 7h17l-1.6 12.2a2 2 0 01-2 1.8H7.1a2 2 0 01-2-1.8L3.5 7z"/>
                </svg>
                <h3>Your cart is empty</h3>
                <p>Looks like you haven't added anything yet.</p>
                <a href="{{ url('/shop') }}" class="btn-main">Start Shopping</a>
            </div>

        @else

            <div class="row g-5">

                <div class="col-lg-8">
                    <div class="cart-items">
                        @foreach ($items as $key => $item)
                            <div class="cart-row">
                                <a href="{{ url($item['url']) }}" class="cart-thumb">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" width="90" height="90">
                                </a>

                                <div class="cart-row-info">
                                    <a href="{{ url($item['url']) }}" class="cart-row-title">{{ $item['title'] }}</a>
                                    @if ($item['size'] || $item['color'])
                                        <div class="cart-row-meta">
                                            @if ($item['size']) Size: {{ $item['size'] }} @endif
                                            @if ($item['size'] && $item['color']) &middot; @endif
                                            @if ($item['color']) Color: {{ $item['color'] }} @endif
                                        </div>
                                    @endif

                                    <form action="{{ url('/cart/remove/' . $key) }}" method="POST" class="cart-remove-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Remove</button>
                                    </form>
                                </div>

                                <form action="{{ url('/cart/update/' . $key) }}" method="POST" class="qty-stepper cart-row-qty">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}">−</button>
                                    <input type="number" value="{{ $item['quantity'] }}" readonly>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}">+</button>
                                </form>

                                <div class="cart-row-price">${{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h4>Order Summary</h4>
                        <div class="summary-line">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 0) }}</span>
                        </div>
                        <div class="summary-line">
                            <span>Shipping</span>
                            <span>{{ $subtotal >= 100 ? 'Free' : '$8' }}</span>
                        </div>
                        <div class="summary-line summary-total">
                            <span>Total</span>
                            <span>${{ number_format($subtotal + ($subtotal >= 100 ? 0 : 8), 0) }}</span>
                        </div>
                        <a href="{{ url('/checkout') }}" class="btn-main d-block text-center">Proceed to Checkout</a>
                        <a href="{{ url('/shop') }}" class="continue-shopping">← Continue Shopping</a>
                    </div>
                </div>

            </div>

        @endif

    </div>

@endsection

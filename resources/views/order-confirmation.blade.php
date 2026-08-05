@extends('layouts.app')

@section('title', 'Order Confirmed — BeFit')

@section('content')

    <div class="container confirmation-page">
        <div class="confirmation-icon">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 6L9 17l-5-5"/>
            </svg>
        </div>

        <h1>Thank you, {{ session('customer_name') }}!</h1>
        <p>Your order has been placed successfully.</p>
        <p>We've sent a confirmation to your email with the order details.</p>

        <div class="order-number-badge">{{ session('order_number') }}</div>

        <div>
            <a href="{{ url('/shop') }}" class="btn-main">Continue Shopping</a>
        </div>
    </div>

@endsection

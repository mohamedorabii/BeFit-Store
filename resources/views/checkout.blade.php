@extends('layouts.app')

@section('title', 'Checkout — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / <a href="{{ url('/cart') }}">Cart</a> / Checkout
            </div>
            <h1>Checkout</h1>
        </div>
    </div>

    <div class="container checkout-page">
        <form action="{{ url('/checkout') }}" method="POST">
            @csrf
            <div class="row g-5">

                <div class="col-lg-7">

                    <div class="checkout-form-block">
                        <h4><span class="step-num">1</span> Shipping Details</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-form-block">
                        <h4><span class="step-num">2</span> Payment Method</h4>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="cod" checked>
                            <div>
                                <div class="p-label">Cash on Delivery</div>
                                <div class="p-sub">Pay when your order arrives.</div>
                            </div>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="card">
                            <div>
                                <div class="p-label">Credit / Debit Card</div>
                                <div class="p-sub">Pay securely online (integration coming soon).</div>
                            </div>
                        </label>
                    </div>

                    @error('full_name') <div class="alert-success" style="background:#fdecea;color:#c0392b;border-color:#f5c6cb;">{{ $message }}</div> @enderror

                </div>

                <div class="col-lg-5">
                    <div class="checkout-summary">
                        <h4>Order Summary</h4>

                        @foreach ($items as $item)
                            <div class="checkout-mini-item">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                                <div>
                                    <div class="m-title">{{ $item['title'] }}</div>
                                    <div class="m-qty">Qty: {{ $item['quantity'] }}</div>
                                </div>
                                <div class="m-price">${{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                            </div>
                        @endforeach

                        <div class="summary-line" style="margin-top:16px;">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 0) }}</span>
                        </div>
                        <div class="summary-line">
                            <span>Shipping</span>
                            <span>{{ $shipping === 0 ? 'Free' : '$' . $shipping }}</span>
                        </div>
                        <div class="summary-line summary-total">
                            <span>Total</span>
                            <span>${{ number_format($total, 0) }}</span>
                        </div>

                        <button type="submit" class="btn-main d-block w-100 text-center" style="border:none;margin-top:20px;">Place Order</button>
                        <a href="{{ url('/cart') }}" class="continue-shopping">← Back to Cart</a>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection

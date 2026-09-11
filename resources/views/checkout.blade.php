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
                            <div class="col-md-6">
                                <label class="form-label">Governorate</label>
                                <select class="form-control" name="governorate" id="governorate-select" required>
                                    <option value="" disabled {{ old('governorate') ? '' : 'selected' }}>Select Governorate</option>
                                    @foreach ($shippingOptions as $option)
                                        <option
                                            value="{{ $option->governorate }}"
                                            data-price="{{ $option->price }}"
                                            {{ old('governorate') === $option->governorate ? 'selected' : '' }}
                                        >
                                            {{ $option->governorate }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('governorate')
                                    <div class="error-message" style="color:#c0392b;font-size:0.85rem;margin-top:4px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @error('full_name') <div class="alert-success" style="background:#fdecea;color:#c0392b;border-color:#f5c6cb;">{{ $message }}</div> @enderror

                </div>

                <div class="col-lg-5">
                    <div class="checkout-summary">
                        <h4>Order Summary</h4>

                        @foreach ($cartItems as $item)
                            <div class="checkout-mini-item">
                                @php
    $itemImage = $item->product->primaryImage->image ?? null;
    $itemImageUrl = $itemImage
        ? (str_starts_with($itemImage, 'http') ? $itemImage : asset('storage/' . ltrim($itemImage, '/')))
        : asset('images/placeholder.png');
@endphp
<img src="{{ $itemImageUrl }}" alt="{{ $item->product->name_en }}">
                                <div>
                                    <div class="m-title">{{ $item->product->name_en }}</div>
                                    <div class="m-qty">
                                        Qty: {{ $item->quantity }} &middot;
                                        {{ $item->variant->size->name_en }} / {{ $item->variant->color->name_en }}
                                    </div>
                                </div>
                                <div class="m-price">${{ number_format($item->unit_price * $item->quantity, 0) }}</div>
                            </div>
                        @endforeach

                        <div class="summary-line" style="margin-top:16px;">
                            <span>Subtotal</span>
                            <span id="subtotal-value">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-line">
                            <span>Shipping</span>
                            <span id="shipping-value">—</span>
                        </div>
                        <div class="summary-line summary-total">
                            <span>Total</span>
                            <span id="total-value">${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <button type="submit" class="btn-main d-block w-100 text-center" style="border:none;margin-top:20px;">Place Order</button>
                        <a href="{{ url('/cart') }}" class="continue-shopping">← Back to Cart</a>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        (function () {
            const subtotal = {{ $subtotal }};
            const select = document.getElementById('governorate-select');
            const shippingEl = document.getElementById('shipping-value');
            const totalEl = document.getElementById('total-value');

            function updateTotal() {
                const selected = select.options[select.selectedIndex];
                const price = parseFloat(selected?.dataset?.price ?? 'NaN');

                if (isNaN(price)) {
                    shippingEl.textContent = '—';
                    totalEl.textContent = '$' + subtotal.toFixed(2);
                    return;
                }

                shippingEl.textContent = '$' + price.toFixed(2);
                totalEl.textContent = '$' + (subtotal + price).toFixed(2);
            }

            select.addEventListener('change', updateTotal);
            updateTotal();
        })();
    </script>

@endsection
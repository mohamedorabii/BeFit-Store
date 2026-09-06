@extends('layouts.app')

@section('title', 'Order Confirmed — BeFit')

@section('content')

    @php
        $vodafoneLink = config('services.vodafone_cash.link');
        $instapayLink = config('services.instapay.link');
        $instapayUsername = config('services.instapay.username');

        $vodafoneQr = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($vodafoneLink ?? '');
        $instapayQr = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($instapayLink ?? '');

        $whatsappMessage =
            "Hi, I just placed order {$order->order_number} for $" .
            number_format($order->total_price, 2) .
            ". Here's my payment receipt.";
        $whatsappUrl =
            'https://wa.me/' . config('services.whatsapp.number') . '?text=' . rawurlencode($whatsappMessage);
    @endphp

    <div class="container confirmation-page">

        <div class="confirmation-icon">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 6L9 17l-5-5" />
            </svg>
        </div>

        <h1>Thank you, {{ $order->name }}!</h1>
        <p>Your order has been placed successfully.</p>
        <p>We'll contact you after payment confirmation to start shipping.</p>

        <div class="order-summary-pill">
            <span>Order Number: <strong>{{ $order->order_number }}</strong></span>
            <span class="divider"></span>
            <span>Total: <strong>${{ number_format($order->total_price, 2) }}</strong></span>
        </div>

        <div class="payment-block">
            <h4>Payment Options</h4>
            <p class="text-muted">Please choose the appropriate payment method and transfer the amount before submitting the
                request.</p>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="payment-card" data-method="instapay">
                        <div class="payment-icon instapay">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" />
                                <line x1="1" y1="10" x2="23" y2="10" />
                            </svg>
                        </div>
                        <h5>Instapay</h5>
                        <p class="text-muted mb-0">Payment via Instapay app</p>

                        @if ($instapayLink)
                            <a href="{{ $instapayLink }}" target="_blank">
                                <img src="{{ $instapayQr }}" alt="Instapay QR" class="qr-code">
                            </a>
                            <div class="payment-details">
                                <p><strong>Username:</strong> {{ $instapayUsername }}</p>
                                <p class="mb-0"><strong>Payment Link:</strong> <a href="{{ $instapayLink }}"
                                        target="_blank">Click to transfer</a></p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="payment-card" data-method="vodafone_cash">
                        <div class="payment-icon vodafone">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                            </svg>
                        </div>
                        <h5>Vodafone Cash</h5>
                        <p class="text-muted mb-0">Payment via Vodafone Cash wallet</p>

                        @if ($vodafoneLink)
                            <a href="{{ $vodafoneLink }}" target="_blank">
                                <img src="{{ $vodafoneQr }}" alt="Vodafone Cash QR" class="qr-code">
                            </a>
                            <div class="payment-details">
                                <p class="mb-0"><strong>Payment Link:</strong> <a href="{{ $vodafoneLink }}"
                                        target="_blank">Click to transfer</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="payment-instructions">
                <strong>Payment Instructions</strong>
                <ul>
                    <li>Use the QR code to transfer directly.</li>
                    <li>Save the payment receipt to send it via WhatsApp to confirm your order.</li>
                </ul>
            </div>
        </div>

        <div class="receipt-block">
            <h4>Send Payment Receipt</h4>
            <p>After payment, please send the receipt via WhatsApp to confirm your order.</p>
            <a href="{{ $whatsappUrl }}" target="_blank" class="whatsapp-link">Send via WhatsApp</a>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('orders.index') }}" class="btn-main">View My Orders</a>
        </div>

    </div>

    <style>
        .confirmation-page {
            max-width: 720px;
            margin: 60px auto;
            text-align: center;
        }

        .confirmation-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #dcfce7;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .order-summary-pill {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            padding: 10px 22px;
            font-size: 0.9rem;
            color: #334155;
            margin: 20px 0 40px;
        }

        .order-summary-pill .divider {
            width: 1px;
            height: 16px;
            background: #cbd5e1;
        }

        .payment-block,
        .receipt-block {
            background: #f0f9ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 24px;
            text-align: left;
        }

        .receipt-block {
            text-align: center;
            background: #fff;
            border: 1px solid #e5e7eb;
        }

        .payment-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            background: #fff;
            padding: 24px;
            text-align: center;
            height: 100%;
        }

        .payment-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .payment-icon.instapay {
            background: #dbeafe;
            color: #2563eb;
        }

        .payment-icon.vodafone {
            background: #dcfce7;
            color: #16a34a;
        }

        .qr-code {
            width: 130px;
            height: 130px;
            margin: 16px auto;
            display: block;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 6px;
            background: #fff;
        }

        .payment-details {
            background: #f8fafc;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            font-size: 0.9rem;
            text-align: left;
        }

        .payment-instructions {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 18px;
            margin-top: 20px;
        }

        .whatsapp-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #25D366;
            color: #fff;
            font-weight: bold;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 12px;
        }

        .whatsapp-link:hover {
            background-color: #128C7E;
            color: #fff;
        }
    </style>

@endsection

@extends('layouts.app')

@section('title', 'Returns & Exchanges — BeFit')

@section('content')

    <div class="page-header-simple">
        <div class="container">
            <h1>Returns &amp; Exchanges</h1>
        </div>
    </div>

    <div class="container static-content" style="max-width:820px;">

        <p class="lead-text">
            Not the right fit? You have 30 days from delivery to return or exchange any unworn
            item with its original tags — no questions asked.
        </p>

        <div class="value-grid" style="grid-template-columns:1fr;gap:16px;">
            <div class="value-card">
                <h5>1. Start your return</h5>
                <p>Email <b>devmohamedalaaoraby@gmail.com</b> with your order number and the item(s) you'd like to return.</p>
            </div>
            <div class="value-card">
                <h5>2. Ship it back</h5>
                <p>We'll send a prepaid return label — pack the item in its original condition and drop it at any courier point.</p>
            </div>
            <div class="value-card">
                <h5>3. Get refunded</h5>
                <p>Once we receive and inspect the item, your refund is issued to the original payment method within 5–7 business days.</p>
            </div>
        </div>

    </div>

@endsection

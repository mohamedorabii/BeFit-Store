@extends('layouts.app')

@section('title', 'Your Wishlist — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / Wishlist
            </div>
            <h1>Your Wishlist</h1>
            <p>{{ count($items) }} {{ count($items) === 1 ? 'item' : 'items' }} saved</p>
        </div>
    </div>

    <div class="container cart-page">

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if (empty($items))

            <div class="empty-cart">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 00-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/>
                </svg>
                <h3>Your wishlist is empty</h3>
                <p>Save items you love for later.</p>
                <a href="{{ url('/shop') }}" class="btn-main">Browse the Shop</a>
            </div>

        @else

            <div class="wishlist-grid">
                @foreach ($items as $key => $item)
                    <div class="wishlist-card">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                        <div class="w-body">
                            <h4>{{ $item['title'] }}</h4>
                            <div class="w-price">${{ number_format($item['price'], 0) }}</div>
                            <div class="w-actions">
                                <a href="{{ url($item['url']) }}">View</a>
                                <form action="{{ url('/wishlist/remove/' . $key) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Remove">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 6h16z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif

    </div>

@endsection

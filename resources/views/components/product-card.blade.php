@props([
    'badge' => null,
    'image' => '',
    'title' => '',
    'description' => '',
    'price' => 0,
    'oldPrice' => null,
    'url' => '#',
])

@php
    $resolvedImage = $image && ! str_starts_with($image, 'http')
        ? asset('storage/' . ltrim($image, '/'))
        : $image;
@endphp

<div class="product-card">
    <a href="{{ url($url) }}" class="product-image d-block">
        @if ($badge)
            <span class="badge-sale">{{ $badge }}</span>
        @endif
        <img src="{{ $resolvedImage }}" alt="{{ $title }}">
    </a>
    <div class="product-content">
        <div class="stars">★★★★★</div>
        <h4><a href="{{ url($url) }}" class="text-reset">{{ $title }}</a></h4>
        <p>{{ $description }}</p>
        <div class="price">
            <span>${{ number_format($price, 0) }}</span>
            @if ($oldPrice)
                <del>${{ number_format($oldPrice, 0) }}</del>
            @endif
        </div>

        <a href="{{ url($url) }}" class="add-cart">Add To Cart</a>
    </div>
</div>
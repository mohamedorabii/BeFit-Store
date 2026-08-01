@props([
    'badge' => null,
    'image' => '',
    'title' => '',
    'description' => '',
    'price' => 0,
    'oldPrice' => null,
    'url' => '#',
])

<div class="product-card">
    <div class="product-image">
        @if ($badge)
            <span class="badge-sale">{{ $badge }}</span>
        @endif
        <img src="{{ $image }}" alt="{{ $title }}">
    </div>
    <div class="product-content">
        <div class="stars">★★★★★</div>
        <h4>{{ $title }}</h4>
        <p>{{ $description }}</p>
        <div class="price">
            <span>${{ number_format($price, 0) }}</span>
            @if ($oldPrice)
                <del>${{ number_format($oldPrice, 0) }}</del>
            @endif
        </div>
        <form action="{{ url('/cart/add') }}" method="POST">
            @csrf
            <input type="hidden" name="url" value="{{ $url }}">
            <button type="submit" class="add-cart">Add To Cart</button>
        </form>
    </div>
</div>

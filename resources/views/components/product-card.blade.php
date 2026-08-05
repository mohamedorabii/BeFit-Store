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
    <a href="{{ url($url) }}" class="product-image d-block">
        @if ($badge)
            <span class="badge-sale">{{ $badge }}</span>
        @endif
        <img src="{{ $image }}" alt="{{ $title }}">
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
        <form action="{{ url('/cart/add') }}" method="POST">
            @csrf
            <input type="hidden" name="url" value="{{ $url }}">
            <input type="hidden" name="title" value="{{ $title }}">
            <input type="hidden" name="price" value="{{ $price }}">
            <input type="hidden" name="image" value="{{ $image }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="add-cart">Add To Cart</button>
        </form>
    </div>
</div>

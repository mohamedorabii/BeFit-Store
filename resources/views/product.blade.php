@extends('layouts.app')

@section('title', $product['title'] . ' — BeFit')

@section('content')

    <div class="container product-page">

        <div class="breadcrumb-custom">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ url('/shop') }}">Shop</a> / {{ $product['title'] }}
        </div>

        <div class="row g-5">

            {{-- Gallery --}}
            <div class="col-lg-6">
                <div class="product-gallery-main">
                    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" id="mainImage">
                </div>
                <div class="product-gallery-thumbs">
                    @foreach ($product['gallery'] as $i => $thumb)
                        <img src="{{ $thumb }}" class="{{ $i === 0 ? 'active' : '' }}"
                             onclick="document.getElementById('mainImage').src=this.src;
                                      document.querySelectorAll('.product-gallery-thumbs img').forEach(t=>t.classList.remove('active'));
                                      this.classList.add('active');">
                    @endforeach
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-6 product-info">

                @if ($product['badge'] ?? null)
                    <span class="badge-sale" style="position:static;display:inline-block;">{{ $product['badge'] }}</span>
                @endif

                <h1 class="p-title">{{ $product['title'] }}</h1>

                <div class="p-stars">★★★★★ <span>({{ $product['reviews_count'] }} reviews)</span></div>

                <div class="p-price">
                    <span class="now">${{ number_format($product['price'], 0) }}</span>
                    @if ($product['old_price'] ?? null)
                        <span class="old">${{ number_format($product['old_price'], 0) }}</span>
                    @endif
                </div>

                <p class="p-desc">{{ $product['description'] }}</p>

                <form action="{{ url('/cart/add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product" value="{{ $product['slug'] }}">

                    <div class="option-group">
                        <div class="opt-title">Size</div>
                        <div class="size-grid">
                            @foreach ($product['sizes'] as $i => $size)
                                <label class="size-btn {{ $i === 2 ? 'active' : '' }}">
                                    <input type="radio" name="size" value="{{ $size }}" style="display:none;" {{ $i === 2 ? 'checked' : '' }}>
                                    {{ $size }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="option-group">
                        <div class="opt-title">Color</div>
                        <div class="color-grid">
                            @foreach ($product['colors'] as $i => $color)
                                <label class="color-dot {{ $i === 0 ? 'active' : '' }}" style="background:{{ $color['hex'] }}" title="{{ $color['name'] }}">
                                    <input type="radio" name="color" value="{{ $color['name'] }}" style="display:none;" {{ $i === 0 ? 'checked' : '' }}>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="qty-cart-row">
                        <div class="qty-stepper">
                            <button type="button" onclick="const i=this.nextElementSibling; if(i.value>1) i.value--;">−</button>
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="button" onclick="this.previousElementSibling.value++;">+</button>
                        </div>
                        <button type="submit" class="add-cart">Add To Cart</button>
                        <button type="button" class="wish-btn" title="Add to wishlist">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 00-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <ul class="p-meta-list">
                    <li><b>SKU</b> {{ $product['sku'] }}</li>
                    <li><b>Category</b> {{ $product['category'] }}</li>
                    <li><b>Availability</b> In Stock</li>
                </ul>

            </div>
        </div>

        {{-- Tabs --}}
        <div class="product-tabs">
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-description" type="button">Description</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-reviews" type="button">Reviews ({{ $product['reviews_count'] }})</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-description">
                    <p>{{ $product['long_description'] }}</p>
                </div>
                <div class="tab-pane fade" id="tab-reviews">
                    <p>Reviews are coming soon for this product.</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Related products --}}
    <section class="related-products">
        <div class="container">
            <div class="section-title">
                <h2>You May Also Like</h2>
                <p>More picks from the same category.</p>
            </div>
            <div class="row g-4">
                @foreach ($relatedProducts as $related)
                    <div class="col-lg-3 col-md-6">
                        <x-product-card
                            :badge="$related['badge'] ?? null"
                            :image="$related['image']"
                            :title="$related['title']"
                            :description="$related['description']"
                            :price="$related['price']"
                            :old-price="$related['old_price'] ?? null"
                            :url="$related['url']"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

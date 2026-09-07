@extends('layouts.app')

@section('title', $product->name_en . ' — BeFit')

@section('content')

    <div class="container product-page">

        <div class="breadcrumb-custom">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ url('/shop') }}">Shop</a> / {{ $product->name_en }}
        </div>

        <div class="row g-5">

            {{-- Gallery --}}
            <div class="col-lg-6">
                @php
                    $mainImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                    $resolveImg = fn($path) => $path && !str_starts_with($path, 'http')
                        ? asset('storage/' . ltrim($path, '/'))
                        : $path;
                @endphp
                <div class="product-gallery-main">
                    <img src="{{ $resolveImg($mainImage->image ?? '') }}" alt="{{ $product->name_en }}" id="mainImage">
                </div>
                <div class="product-gallery-thumbs">
                    @foreach ($product->images as $i => $thumb)
                        <img src="{{ $resolveImg($thumb->image) }}" class="{{ $i === 0 ? 'active' : '' }}"
                            onclick="document.getElementById('mainImage').src=this.src;
                          document.querySelectorAll('.product-gallery-thumbs img').forEach(t=>t.classList.remove('active'));
                          this.classList.add('active');">
                    @endforeach
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-6 product-info">

                @if ($product->badge)
                    <span class="badge-sale" style="position:static;display:inline-block;">{{ $product->badge }}</span>
                @endif

                <h1 class="p-title">{{ $product->name_en }}</h1>

                <div class="p-stars">★★★★★ <span>(0 reviews)</span></div>

                <div class="p-price">
                    <span class="now">${{ number_format($product->price, 0) }}</span>
                    @if ($product->old_price)
                        <span class="old">${{ number_format($product->old_price, 0) }}</span>
                    @endif
                </div>

                <p class="p-desc">{{ $product->description_en }}</p>

                <form action="{{ url('/cart/add') }}" method="POST" id="addToCartForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" id="selectedVariantId" value="">

                    <div class="option-group">
                        <div class="opt-title">Size</div>
                        <div class="size-grid">
                            @foreach ($sizes as $size)
                                <label class="size-btn" data-size-id="{{ $size->id }}">
                                    <input type="radio" name="size_id" value="{{ $size->id }}" style="display:none;"
                                        onchange="selectSize({{ $size->id }})">
                                    {{ $size->name_en }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="option-group">
                        <div class="opt-title">Color</div>
                        <div class="color-grid">
                            @foreach ($colors as $color)
                                <label class="color-dot" data-color-id="{{ $color->id }}"
                                    style="background:{{ $color->hex_code }}" title="{{ $color->name_en }}">
                                    <input type="radio" name="color_id" value="{{ $color->id }}" style="display:none;"
                                        onchange="selectColor({{ $color->id }})">
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <p id="stockMessage" class="text-muted small"></p>

                    <div class="qty-cart-row">
                        <div class="qty-stepper">
                            <button type="button"
                                onclick="const i=this.nextElementSibling; if(i.value>1) i.value--;">−</button>
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="button" onclick="this.previousElementSibling.value++;">+</button>
                        </div>
                        <button type="submit" class="add-cart" id="addToCartBtn" disabled>Select Size & Color</button>
                    </div>
                </form>

                <form action="{{ url('/wishlist/add') }}" method="POST" class="qty-cart-row" style="margin-top:-14px;">
                    @csrf
                    <input type="hidden" name="title" value="{{ $product->name_en }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="image" value="{{ $resolveImg($mainImage->image ?? '') }}">
                    <input type="hidden" name="url" value="/product/{{ $product->slug }}">
                    <button type="submit" class="wish-btn" title="Add to wishlist"
                        style="width:auto;padding:0 20px;gap:8px;display:flex;align-items:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path
                                d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 00-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z" />
                        </svg>
                        Save to Wishlist
                    </button>
                </form>

                <ul class="p-meta-list">
                    <li><b>SKU</b> <span id="skuDisplay">—</span></li>
                    <li><b>Category</b> {{ $product->category->name_en }}</li>
                    <li><b>Availability</b> <span id="availabilityDisplay">Select size & color</span></li>
                </ul>

            </div>
        </div>

        {{-- Tabs --}}
        <div class="product-tabs">
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-description"
                        type="button">Description</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-reviews" type="button">Reviews
                        (0)</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-description">
                    <p>{{ $product->description_en }}</p>
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
                        <x-product-card :badge="$related->badge" :image="$related->primaryImage->image ?? ''" :title="$related->name_en" :description="$related->description_en"
                            :price="$related->price" :old-price="$related->old_price" :url="'/product/' . $related->slug" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        const variants = @json($variantsJson);

        let selectedColorId = null;
        let selectedSizeId = null;

        function selectColor(colorId) {
            selectedColorId = colorId;
            document.querySelectorAll('.color-dot').forEach(el => el.classList.remove('active'));
            document.querySelector(`.color-dot[data-color-id="${colorId}"]`).classList.add('active');
            updateVariant();
        }

        function selectSize(sizeId) {
            selectedSizeId = sizeId;
            document.querySelectorAll('.size-btn').forEach(el => el.classList.remove('active'));
            document.querySelector(`.size-btn[data-size-id="${sizeId}"]`).classList.add('active');
            updateVariant();
        }

        function updateVariant() {
            const btn = document.getElementById('addToCartBtn');
            const stockMsg = document.getElementById('stockMessage');
            const variantInput = document.getElementById('selectedVariantId');
            const skuDisplay = document.getElementById('skuDisplay');
            const availabilityDisplay = document.getElementById('availabilityDisplay');

            if (!selectedColorId || !selectedSizeId) {
                btn.disabled = true;
                btn.textContent = 'Select Size & Color';
                stockMsg.textContent = '';
                variantInput.value = '';
                return;
            }

            const match = variants.find(v => v.color_id === selectedColorId && v.size_id === selectedSizeId);

            if (!match) {
                btn.disabled = true;
                btn.textContent = 'Not Available';
                stockMsg.textContent = 'This combination is not available.';
                variantInput.value = '';
                skuDisplay.textContent = '—';
                availabilityDisplay.textContent = 'Not available';
                return;
            }

            variantInput.value = match.id;
            skuDisplay.textContent = match.sku;

            if (match.stock <= 0) {
                btn.disabled = true;
                btn.textContent = 'Out of Stock';
                stockMsg.textContent = 'Out of stock.';
                availabilityDisplay.textContent = 'Out of stock';
            } else {
                btn.disabled = false;
                btn.textContent = 'Add To Cart';
                stockMsg.textContent = `${match.stock} in stock`;
                availabilityDisplay.textContent = 'In Stock';
            }
        }
    </script>

@endsection

@extends('layouts.app')

@section('title', 'BeFit — Achieving Wellness')

@section('content')

    <x-hero-banner />

    {{-- Features --}}
    <section class="features">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <x-feature-box icon="fa-solid fa-truck-fast" title="Free Shipping" text="On all orders over $100." />
                </div>
                <div class="col-lg-3 col-md-6">
                    <x-feature-box icon="fa-solid fa-medal" title="Premium Quality" text="High performance materials." />
                </div>
                <div class="col-lg-3 col-md-6">
                    <x-feature-box icon="fa-solid fa-rotate-left" title="Easy Returns" text="30 days return policy." />
                </div>
                <div class="col-lg-3 col-md-6">
                    <x-feature-box icon="fa-solid fa-shield" title="Secure Payment" text="100% protected checkout." />
                </div>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Shop By Category</h2>
                <p>Find your perfect sportswear.</p>
            </div>

            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-lg-4">
                        <x-category-card :image="$category['image']" :title="$category['title']" :url="$category['url']" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured products --}}
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
                <p>Best selling sportswear this week.</p>
            </div>

            <div class="row g-4">
                @foreach ($featuredProducts as $product)
                    <div class="col-lg-3 col-md-6">
                        <x-product-card
                            :badge="$product['badge'] ?? null"
                            :image="$product['image']"
                            :title="$product['title']"
                            :description="$product['description']"
                            :price="$product['price']"
                            :old-price="$product['old_price'] ?? null"
                            :url="$product['url']"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-offer-box />

@endsection

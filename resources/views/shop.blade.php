@extends('layouts.app')

@section('title', 'Shop — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / Shop
            </div>
            <h1>Shop All</h1>
            <p>{{ $products->total() }} products found</p>
        </div>
    </div>

    <div class="container shop-layout">
        <div class="row g-4">

            <div class="col-lg-3">
                <x-shop-filters :categories="$categories" />
            </div>

            <div class="col-lg-9">

                <div class="sort-bar">
                    <span class="result-count">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }}</span>
                    <select class="sort-select">
                        <option>Sort by: Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest</option>
                    </select>
                </div>

                <div class="row g-4">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6">
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
                    @empty
                        <p class="text-center text-muted py-5">No products match these filters yet.</p>
                    @endforelse
                </div>

                @if ($products->hasPages())
                    <div class="shop-pagination">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection

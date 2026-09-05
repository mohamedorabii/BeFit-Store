@extends('layouts.app')

@section('title', 'Shop — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a> / Shop
            </div>
            <h1>Shop All</h1>
            <p>{{ $products->total() }} products found</p>
        </div>
    </div>

    <div class="container shop-layout">
        <div class="row g-4">

            <div class="col-lg-3">
                <x-shop-filters :categories="$categories" :sizes="$sizes" :colors="$colors" />
            </div>

            <div class="col-lg-9">

                <div class="sort-bar">
                    <span class="result-count">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of
                        {{ $products->total() }}</span>
                    <select class="sort-select" onchange="window.location.href = updateQueryParam('sort', this.value)">
                        <option value="featured" {{ request('sort', 'featured') === 'featured' ? 'selected' : '' }}>Sort by:
                            Featured</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High
                        </option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to
                            Low</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>

                <div class="row g-4">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <x-product-card :badge="$product->badge" :image="$product->primaryImage->image ?? ''" :title="$product->name_en" :description="$product->description_en"
                                :price="$product->price" :old-price="$product->old_price" :url="'/product/' . $product->slug" />
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
<script>
    function updateQueryParam(key, value) {
        const url = new URL(window.location.href);
        url.searchParams.set(key, value);
        url.searchParams.delete('page');
        return url.toString();
    }
</script>
@endsection

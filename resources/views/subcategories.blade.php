@extends('layouts.app')

@section('title', 'Subcategories — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / Subcategories
            </div>
            <h1>All Subcategories</h1>
            <p>Browse the full BeFit range by subcategory.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row g-4">
                @foreach ($subcategories as $subcategory)
                    <div class="col-lg-4 col-md-6">
                        <x-category-card
                            :image="$subcategory['image']"
                            :title="$subcategory['title']"
                            :url="$subcategory['url']"
                            :count="$subcategory['count']"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
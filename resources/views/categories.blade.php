@extends('layouts.app')

@section('title', 'Categories — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / Categories
            </div>
            <h1>All Categories</h1>
            <p>Browse the full BeFit range by category.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6">
                        <x-category-card
                            :image="$category['image']"
                            :title="$category['title']"
                            :url="$category['url']"
                            :count="$category['count']"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

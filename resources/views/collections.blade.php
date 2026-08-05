@extends('layouts.app')

@section('title', 'Collections — BeFit')

@section('content')

    <div class="shop-header">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="{{ url('/') }}">Home</a> / Collections
            </div>
            <h1>Collections</h1>
            <p>Curated edits, built around how you train.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="collections-stack">
                @foreach ($collections as $i => $collection)
                    <a href="{{ url($collection['url']) }}" class="collection-banner {{ $i % 2 === 1 ? 'reverse' : '' }}">
                        <div class="collection-banner-img">
                            <img src="{{ $collection['image'] }}" alt="{{ $collection['title'] }}" width="700" height="420">
                        </div>
                        <div class="collection-banner-body">
                            <span class="collection-index">0{{ $i + 1 }}</span>
                            <h2>{{ $collection['title'] }}</h2>
                            <p>{{ $collection['tagline'] }}</p>
                            <span class="collection-cta">Shop the Collection →</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection

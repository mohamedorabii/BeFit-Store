@props([
    'image' => '',
    'title' => '',
    'url' => '/shop',
    'count' => null,
])

@php
    $src = $image && str_starts_with($image, 'http')
        ? $image
        : asset('storage/' . ($image ?: 'categories/default.png'));
@endphp

<a href="{{ url($url) }}" class="category-card d-block">
    <img src="{{ $src }}" alt="{{ $title }}" width="600" height="380">
    <div class="category-overlay">
        <div>
            <h3>{{ $title }}</h3>
            <span>
                @if ($count !== null)
                    {{ $count }} products →
                @else
                    Shop Now →
                @endif
            </span>
        </div>
    </div>
</a>
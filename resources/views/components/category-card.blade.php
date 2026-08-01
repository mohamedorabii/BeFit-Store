@props([
    'image' => '',
    'title' => '',
    'url' => '/shop',
    'count' => null,
])

<a href="{{ url($url) }}" class="category-card d-block">
    <img src="{{ $image }}" alt="{{ $title }}" width="600" height="380">
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

@props([
    'image' => '',
    'title' => '',
    'url' => '/shop',
])

<a href="{{ url($url) }}" class="category-card d-block">
    <img src="{{ $image }}" alt="{{ $title }}">
    <div class="category-overlay">
        <div>
            <h3>{{ $title }}</h3>
            <span>Shop Now →</span>
        </div>
    </div>
</a>

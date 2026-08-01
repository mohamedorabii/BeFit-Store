@props([
    'categories' => [],
    'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
    'colors' => [
        ['name' => 'Navy', 'hex' => '#1B2A4A'],
        ['name' => 'Black', 'hex' => '#16140F'],
        ['name' => 'White', 'hex' => '#FFFFFF'],
        ['name' => 'Gray', 'hex' => '#9CA3AF'],
        ['name' => 'Red', 'hex' => '#C0392B'],
    ],
])

<aside class="filters-panel">

    <div class="filter-group d-flex justify-content-between align-items-center">
        <span class="filter-title mb-0">Filters</span>
        <button type="button" class="clear-filters">Clear all</button>
    </div>

    <div class="filter-group">
        <div class="filter-title">Category</div>
        @foreach ($categories as $category)
            <label class="filter-check">
                <input type="checkbox" name="category[]" value="{{ $category['slug'] }}">
                {{ $category['title'] }}
                <span class="count">({{ $category['count'] }})</span>
            </label>
        @endforeach
    </div>

    <div class="filter-group">
        <div class="filter-title">Price</div>
        <div class="d-flex gap-2">
            <input type="number" class="form-control" placeholder="Min" name="price_min">
            <input type="number" class="form-control" placeholder="Max" name="price_max">
        </div>
    </div>

    <div class="filter-group">
        <div class="filter-title">Size</div>
        <div class="size-grid">
            @foreach ($sizes as $size)
                <div class="size-btn" data-size="{{ $size }}">{{ $size }}</div>
            @endforeach
        </div>
    </div>

    <div class="filter-group">
        <div class="filter-title">Color</div>
        <div class="color-grid">
            @foreach ($colors as $color)
                <div class="color-dot" style="background:{{ $color['hex'] }}" title="{{ $color['name'] }}" data-color="{{ $color['name'] }}"></div>
            @endforeach
        </div>
    </div>

</aside>

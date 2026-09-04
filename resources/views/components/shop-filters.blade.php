@props([
    'categories' => [],
    'sizes' => [],
    'colors' => [],
])

<aside class="filters-panel">

    <form method="GET" action="{{ url('/shop') }}" id="filters-form">

        <div class="filter-group d-flex justify-content-between align-items-center">
            <span class="filter-title mb-0">Filters</span>
            <a href="{{ url('/shop') }}" class="clear-filters">Clear all</a>
        </div>

        <div class="filter-group">
            <div class="filter-title">Category</div>
            @foreach ($categories as $category)
                <label class="filter-check">
                    <input
                        type="checkbox"
                        name="category[]"
                        value="{{ $category->slug }}"
                        onchange="document.getElementById('filters-form').submit()"
                        {{ in_array($category->slug, (array) request('category', [])) ? 'checked' : '' }}
                    >
                    {{ $category->name_en }}
                    <span class="count">({{ $category->products_count }})</span>
                </label>
            @endforeach
        </div>

        <div class="filter-group">
            <div class="filter-title">Price</div>
            <div class="d-flex gap-2">
                <input type="number" class="form-control" placeholder="Min" name="price_min" value="{{ request('price_min') }}">
                <input type="number" class="form-control" placeholder="Max" name="price_max" value="{{ request('price_max') }}">
            </div>
            <button type="submit" class="btn btn-sm btn-primary mt-2 w-100">Apply</button>
        </div>

        <div class="filter-group">
            <div class="filter-title">Size</div>
            <div class="size-grid">
                @foreach ($sizes as $size)
                    <label class="size-btn {{ in_array($size->name_en, (array) request('size', [])) ? 'active' : '' }}">
                        <input
                            type="checkbox"
                            name="size[]"
                            value="{{ $size->name_en }}"
                            class="d-none"
                            onchange="document.getElementById('filters-form').submit()"
                            {{ in_array($size->name_en, (array) request('size', [])) ? 'checked' : '' }}
                        >
                        {{ $size->name_en }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="filter-group">
            <div class="filter-title">Color</div>
            <div class="color-grid">
                @foreach ($colors as $color)
                    <label class="color-dot {{ in_array($color->name_en, (array) request('color', [])) ? 'active' : '' }}" style="background:{{ $color->hex_code }}" title="{{ $color->name_en }}">
                        <input
                            type="checkbox"
                            name="color[]"
                            value="{{ $color->name_en }}"
                            class="d-none"
                            onchange="document.getElementById('filters-form').submit()"
                            {{ in_array($color->name_en, (array) request('color', [])) ? 'checked' : '' }}
                        >
                    </label>
                @endforeach
            </div>
        </div>

    </form>

</aside>
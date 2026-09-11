<nav class="navbar navbar-expand-lg">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            Be<span>Fit</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="nav">

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('shop*') ? 'active' : '' }}" href="{{ url('/shop') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}"
                        href="{{ url('/categories') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('subcategories*') ? 'active' : '' }}"
                        href="{{ url('/subcategories') }}">Subcategories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('collections*') ? 'active' : '' }}"
                        href="{{ url('/collections') }}">Collections</a>
                </li>
               @auth
    <li class="nav-item">
        <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}"
            href="{{ url('/orders') }}">My Orders</a>
    </li>
@endauth
                
            </ul>

            <div class="nav-icons">
                <div class="nav-search-wrapper position-relative">
    <i class="fa-solid fa-magnifying-glass" id="searchToggle" title="Search" role="button"></i>

    <div id="searchBox" class="nav-search-box" style="display:none;">
        <input type="text" id="searchInput" placeholder="Search products..." autocomplete="off">
        <div id="searchResults" class="search-results-dropdown"></div>
    </div>
</div>
                <a href="{{ url('/wishlist') }}"><i class="fa-regular fa-heart" title="Wishlist"></i></a>
               
                @auth
                    <a href="{{ route('profile.edit') }}" title="My profile">
                        <i class="fa-solid fa-user"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}"><i class="fa-regular fa-user" title="Sign in"></i></a>
                @endauth
                <a href="{{ url('/cart') }}" class="position-relative">
                    <i class="fa-solid fa-bag-shopping" title="Cart"></i>
                    @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                    @if ($cartCount > 0)
                        <span class="nav-cart-count">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>

        </div>
    </div>
    <script>
(function () {
    const toggle = document.getElementById('searchToggle');
    const box = document.getElementById('searchBox');
    const input = document.getElementById('searchInput');
    const resultsBox = document.getElementById('searchResults');
    let debounceTimer = null;

    toggle.addEventListener('click', () => {
        const isHidden = box.style.display === 'none' || !box.style.display;
        box.style.display = isHidden ? 'block' : 'none';
        if (isHidden) input.focus();
    });

    input.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        const query = input.value.trim();

        if (query.length < 2) {
            resultsBox.innerHTML = '';
            resultsBox.style.display = 'none';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`/search/products?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(items => {
                    if (items.length === 0) {
                        resultsBox.innerHTML = '<div class="search-no-results">No products found.</div>';
                    } else {
                        resultsBox.innerHTML = items.map(item => {
                            const name = document.createElement('div');
                            name.textContent = item.name;
                            return `
                                <a href="${item.url}" class="search-result-item">
                                    <img src="${item.image}" alt="${name.textContent.replace(/"/g, '&quot;')}">
                                    <div>
                                        <div class="sr-title">${name.innerHTML}</div>
                                        <div class="sr-price">$${item.price}</div>
                                    </div>
                                </a>`;
                        }).join('');
                    }
                    resultsBox.style.display = 'block';
                });
        }, 300);
    });

    document.addEventListener('click', (e) => {
        if (!box.contains(e.target) && e.target !== toggle) {
            box.style.display = 'none';
        }
    });
})();
</script>
</nav>

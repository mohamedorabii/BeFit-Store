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
                    <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ url('/categories') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('collections*') ? 'active' : '' }}" href="{{ url('/collections') }}">Collections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
                </li>
            </ul>

            <div class="nav-icons">
                <i class="fa-solid fa-magnifying-glass" title="Search"></i>
                <a href="{{ url('/wishlist') }}"><i class="fa-regular fa-heart" title="Wishlist"></i></a>
                <a href="{{ url('/login') }}"><i class="fa-regular fa-user" title="Account"></i></a>
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
</nav>

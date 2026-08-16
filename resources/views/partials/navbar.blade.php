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
                @auth('admin')
                    <a href="{{ url('/admin') }}" class="admin-dashboard-link" title="Admin Dashboard">
                        <i class="fa-solid fa-gauge-high"></i>
                    </a>
                @endauth
                @auth
                    <div class="dropdown">
                        <button class="account-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Account">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end account-menu">
                            <li><span class="dropdown-item-text">Hi, {{ auth()->user()->name }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
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
</nav>

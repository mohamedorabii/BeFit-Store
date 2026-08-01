<footer>
    <div class="container">
        <div class="row">

            <div class="col-lg-4">
                <h4>BeFit</h4>
                <p>Premium Sportswear Store built for athletes and everyday champions.</p>
            </div>

            <div class="col-lg-2">
                <h4>Shop</h4>
                <ul>
                    <li><a href="{{ url('/shop?category=men') }}">Men</a></li>
                    <li><a href="{{ url('/shop?category=women') }}">Women</a></li>
                    <li><a href="{{ url('/shop?category=shoes') }}">Shoes</a></li>
                    <li><a href="{{ url('/shop?category=accessories') }}">Accessories</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h4>Support</h4>
                <ul>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="{{ url('/returns') }}">Returns</a></li>
                    <li><a href="{{ url('/faq') }}">FAQ</a></li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h4>Follow Us</h4>
                <p>
                    <i class="fab fa-facebook-f me-3"></i>
                    <i class="fab fa-instagram me-3"></i>
                    <i class="fab fa-x-twitter me-3"></i>
                    <i class="fab fa-linkedin"></i>
                </p>
            </div>

        </div>

        <div class="copyright">
            © {{ now()->year }} BeFit. All Rights Reserved.
        </div>
    </div>
</footer>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BeFit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #07111F;
            color: white;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }

        :root {
            --primary: #2D8CFF;
            --dark: #07111F;
            --gray: #9EA7B8;
        }

        /* =======================
            TOP BAR
        ==========================*/

        .top-bar {
            background: #03101c;
            padding: 10px 0;
            font-size: 14px;
            color: #d2d7df;
        }

        .top-bar span {
            margin-right: 25px;
        }

        /* =======================
            NAVBAR
        ==========================*/

        .navbar {
            padding: 18px 0;
            background: transparent;
        }

        .navbar-brand {
            font-size: 34px;
            font-weight: 800;
            color: white;
        }

        .navbar-brand span {
            color: var(--primary);
        }

        .nav-link {
            color: white;
            margin: 0 12px;
            font-weight: 500;
            transition: .3s;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-icons i {
            margin-left: 22px;
            cursor: pointer;
            transition: .3s;
        }

        .nav-icons i:hover {
            color: var(--primary);
        }

        /* =======================
            HERO
        ==========================*/

        .hero {

            min-height: 92vh;

            position: relative;

            display: flex;

            align-items: center;

            overflow: hidden;
        }

        .hero::before {

            content: "";

            position: absolute;

            width: 700px;

            height: 700px;

            background: var(--primary);

            right: -250px;

            top: -250px;

            opacity: .12;

            filter: blur(170px);

            border-radius: 50%;
        }

        .hero h5 {

            color: var(--primary);

            letter-spacing: 5px;

            margin-bottom: 15px;
        }

        .hero h1 {

            font-size: 80px;

            font-weight: 800;

            line-height: 90px;
        }

        .hero p {

            color: var(--gray);

            font-size: 17px;

            margin: 25px 0 40px;
        }

        .btn-main {

            background: var(--primary);

            color: white;

            border-radius: 10px;

            padding: 16px 38px;

            font-weight: 600;

            transition: .4s;
        }

        .btn-main:hover {

            transform: translateY(-5px);

            background: #4b9dff;

            color: white;
        }

        .btn-outline-custom {

            border: 1px solid rgba(255, 255, 255, .15);

            color: white;

            margin-left: 15px;

            padding: 16px 38px;

            border-radius: 10px;
        }

        .btn-outline-custom:hover {

            background: white;

            color: black;
        }

        .hero-image {

            position: relative;

            z-index: 2;
        }

        .hero-image img {

            width: 100%;

            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {

            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-18px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .bg-title {

            position: absolute;

            font-size: 210px;

            font-weight: 800;

            color: rgba(255, 255, 255, .03);

            left: 50%;

            top: 48%;

            transform: translate(-50%, -50%);

            user-select: none;

            white-space: nowrap;
        }
        /*========================
FEATURES
========================*/

.features{
    margin-top:-40px;
    position:relative;
    z-index:10;
}

.feature-box{

    background:#0f1d33;

    border:1px solid rgba(255,255,255,.05);

    border-radius:18px;

    padding:30px;

    transition:.35s;

    height:100%;
}

.feature-box:hover{

    transform:translateY(-10px);

    border-color:var(--primary);

    box-shadow:0 15px 40px rgba(45,140,255,.15);
}

.feature-box i{

    width:65px;
    height:65px;

    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    background:rgba(45,140,255,.12);

    color:var(--primary);

    font-size:26px;

    margin-bottom:20px;
}

.feature-box h4{

    font-size:22px;
    font-weight:700;
}

.feature-box p{

    color:#9ea7b8;
    margin-top:12px;
}

/*========================
CATEGORY
========================*/

.section{

    padding:100px 0;
}

.section-title{

    text-align:center;
    margin-bottom:60px;
}

.section-title h2{

    font-size:46px;
    font-weight:800;
}

.section-title p{

    color:#94a0b5;
}

.category-card{

    position:relative;

    overflow:hidden;

    border-radius:22px;

    cursor:pointer;
}

.category-card img{

    width:100%;

    height:380px;

    object-fit:cover;

    transition:.5s;
}

.category-card:hover img{

    transform:scale(1.08);
}

.category-overlay{

    position:absolute;

    inset:0;

    background:linear-gradient(to top,#07111f,transparent);

    display:flex;

    align-items:flex-end;

    padding:30px;
}

.category-overlay h3{

    font-size:32px;

    font-weight:700;
}

.category-overlay span{

    color:var(--primary);
}
/*========================
PRODUCTS
========================*/

.product-card{
    background:#0d1728;
    border-radius:20px;
    overflow:hidden;
    transition:.35s;
    border:1px solid rgba(255,255,255,.05);
}

.product-card:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 40px rgba(45,140,255,.15);
}

.product-image{
    height:320px;
    overflow:hidden;
    position:relative;
}

.product-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.5s;
}

.product-card:hover img{
    transform:scale(1.08);
}

.badge-sale{
    position:absolute;
    top:20px;
    left:20px;
    background:#2D8CFF;
    color:#fff;
    padding:6px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
}

.product-content{
    padding:25px;
}

.product-content h4{
    font-size:22px;
    font-weight:700;
    margin-bottom:10px;
}

.product-content p{
    color:#9ea7b8;
    font-size:15px;
}

.price{
    margin:20px 0;
}

.price span:first-child{
    color:#2D8CFF;
    font-size:25px;
    font-weight:700;
}

.price del{
    color:#7f8a9b;
    margin-left:10px;
}

.add-cart{
    width:100%;
    border:none;
    background:#2D8CFF;
    color:white;
    padding:14px;
    border-radius:12px;
    font-weight:600;
    transition:.3s;
}

.add-cart:hover{
    background:#4b9dff;
}

.stars{
    color:#ffc107;
    margin-bottom:15px;
}
/*==========================
OFFER
===========================*/

.offer{

    padding:100px 0;
}

.offer-box{

    border-radius:30px;

    padding:70px;

    background:linear-gradient(135deg,#0c1830,#2d8cff);

    position:relative;

    overflow:hidden;
}

.offer-box::before{

    content:"";

    position:absolute;

    width:400px;

    height:400px;

    background:rgba(255,255,255,.08);

    border-radius:50%;

    top:-150px;

    right:-120px;
}

.offer-box h5{

    color:#9fd0ff;

    letter-spacing:4px;
}

.offer-box h2{

    font-size:52px;

    font-weight:800;

    margin:20px 0;
}

.offer-box p{

    color:#d7e8ff;

    margin-bottom:35px;
}

/*==========================
FOOTER
===========================*/

footer{

    background:#030913;

    padding:80px 0 30px;
}

footer h4{

    font-size:24px;

    font-weight:700;

    margin-bottom:25px;
}

footer p{

    color:#98a5ba;
}

footer ul{

    list-style:none;

    padding:0;
}

footer li{

    margin-bottom:12px;
}

footer a{

    color:#98a5ba;

    transition:.3s;
}

footer a:hover{

    color:#2D8CFF;
}

.copyright{

    border-top:1px solid rgba(255,255,255,.05);

    margin-top:60px;

    padding-top:25px;

    text-align:center;

    color:#8e99aa;
}
    </style>

</head>

<body>

    <div class="top-bar">

        <div class="container d-flex justify-content-between">

            <div>

                <span><i class="fa-solid fa-truck"></i> Free Shipping</span>

                <span><i class="fa-solid fa-rotate-left"></i> Free Returns</span>

            </div>

            <div>

                Follow Us

                <i class="fab fa-facebook-f ms-3"></i>

                <i class="fab fa-instagram ms-3"></i>

                <i class="fab fa-x-twitter ms-3"></i>

            </div>

        </div>

    </div>

    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <a class="navbar-brand" href="#">Be<span>Fit</span></a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">

                <i class="fa-solid fa-bars text-white"></i>

            </button>

            <div class="collapse navbar-collapse" id="nav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>

                    <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>

                    <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>

                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>

                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>

                </ul>

                <div class="nav-icons">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <i class="fa-regular fa-heart"></i>

                    <i class="fa-regular fa-user"></i>

                    <i class="fa-solid fa-bag-shopping"></i>

                </div>

            </div>

        </div>

    </nav>

    <section class="hero">

        <div class="bg-title">BEFIT</div>

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <h5>NEW COLLECTION</h5>

                    <h1>Performance Meets Style.</h1>

                    <p>

                        Discover premium sportswear designed for movement,
                        comfort and confidence.

                    </p>

                    <a href="#" class="btn btn-main">

                        Shop Now

                    </a>

                    <a href="#" class="btn btn-outline-custom">

                        Explore

                    </a>

                </div>

                <div class="col-lg-6 hero-image text-center">

                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=900&auto=format&fit=crop"
                        class="img-fluid">

                </div>

            </div>

        </div>

    </section>
    <section class="features">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="feature-box">

                    <i class="fa-solid fa-truck-fast"></i>

                    <h4>Free Shipping</h4>

                    <p>On all orders over $100.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="feature-box">

                    <i class="fa-solid fa-medal"></i>

                    <h4>Premium Quality</h4>

                    <p>High performance materials.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="feature-box">

                    <i class="fa-solid fa-rotate-left"></i>

                    <h4>Easy Returns</h4>

                    <p>30 days return policy.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="feature-box">

                    <i class="fa-solid fa-shield"></i>

                    <h4>Secure Payment</h4>

                    <p>100% protected checkout.</p>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="section">

    <div class="container">

        <div class="section-title">

            <h2>Shop By Category</h2>

            <p>Find your perfect sportswear.</p>

        </div>

        <div class="row g-4">

            <div class="col-lg-4">

                <div class="category-card">

                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=900&auto=format&fit=crop">

                    <div class="category-overlay">

                        <div>

                            <h3>Men</h3>

                            <span>Shop Now →</span>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="category-card">

                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop">

                    <div class="category-overlay">

                        <div>

                            <h3>Women</h3>

                            <span>Shop Now →</span>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="category-card">

                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop">

                    <div class="category-overlay">

                        <div>

                            <h3>Shoes</h3>

                            <span>Shop Now →</span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<section class="section">

    <div class="container">

        <div class="section-title">

            <h2>Featured Products</h2>

            <p>Best selling sportswear this week.</p>

        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <span class="badge-sale">NEW</span>

                        <img src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=900&auto=format&fit=crop">

                    </div>

                    <div class="product-content">

                        <div class="stars">
                            ★★★★★
                        </div>

                        <h4>Sport T-Shirt</h4>

                        <p>Breathable fabric for everyday training.</p>

                        <div class="price">

                            <span>$39</span>

                            <del>$55</del>

                        </div>

                        <button class="add-cart">

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <span class="badge-sale">HOT</span>

                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop">

                    </div>

                    <div class="product-content">

                        <div class="stars">
                            ★★★★★
                        </div>

                        <h4>Running Shoes</h4>

                        <p>Comfort & performance combined.</p>

                        <div class="price">

                            <span>$79</span>

                            <del>$110</del>

                        </div>

                        <button class="add-cart">

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <span class="badge-sale">SALE</span>

                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop">

                    </div>

                    <div class="product-content">

                        <div class="stars">
                            ★★★★★
                        </div>

                        <h4>Training Shorts</h4>

                        <p>Flexible fit with premium comfort.</p>

                        <div class="price">

                            <span>$29</span>

                            <del>$45</del>

                        </div>

                        <button class="add-cart">

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="product-card">

                    <div class="product-image">

                        <span class="badge-sale">-25%</span>

                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=900&auto=format&fit=crop">

                    </div>

                    <div class="product-content">

                        <div class="stars">
                            ★★★★★
                        </div>

                        <h4>Women's Set</h4>

                        <p>Premium gym collection.</p>

                        <div class="price">

                            <span>$65</span>

                            <del>$90</del>

                        </div>

                        <button class="add-cart">

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<section class="offer">

    <div class="container">

        <div class="offer-box">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <h5>LIMITED OFFER</h5>

                    <h2>Up To 50% OFF</h2>

                    <p>

                        Upgrade your performance with the latest sportswear
                        collection.

                    </p>

                    <a href="#" class="btn btn-light px-5 py-3">

                        Shop Collection

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>
<footer>

    <div class="container">

        <div class="row">

            <div class="col-lg-4">

                <h4>BeFit</h4>

                <p>

                    Premium Sportswear Store built for athletes and everyday
                    champions.

                </p>

            </div>

            <div class="col-lg-2">

                <h4>Shop</h4>

                <ul>

                    <li><a href="#">Men</a></li>

                    <li><a href="#">Women</a></li>

                    <li><a href="#">Shoes</a></li>

                    <li><a href="#">Accessories</a></li>

                </ul>

            </div>

            <div class="col-lg-3">

                <h4>Support</h4>

                <ul>

                    <li><a href="#">Contact</a></li>

                    <li><a href="#">Returns</a></li>

                    <li><a href="#">FAQ</a></li>

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

            © 2026 BeFit. All Rights Reserved.

        </div>

    </div>

</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
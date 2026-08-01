@props([
    'tag' => 'LIMITED OFFER',
    'title' => 'Up To 50% OFF',
    'text' => 'Upgrade your performance with the latest sportswear collection.',
    'ctaLabel' => 'Shop Collection',
    'ctaUrl' => '/shop',
])

<section class="offer">
    <div class="container">
        <div class="offer-box">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h5>{{ $tag }}</h5>
                    <h2>{{ $title }}</h2>
                    <p>{{ $text }}</p>
                    <a href="{{ url($ctaUrl) }}" class="btn btn-light px-5 py-3">{{ $ctaLabel }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

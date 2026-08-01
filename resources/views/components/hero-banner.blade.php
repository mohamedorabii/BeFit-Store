@props([
    'image' => asset('images/befit-hero.jpeg'),
    'tag' => 'NEW COLLECTION',
    'text' => 'Achieving Wellness — Performance. Comfort. Confidence.',
    'primaryCta' => ['label' => 'Shop Now', 'url' => '/shop'],
    'secondaryCta' => ['label' => 'Explore', 'url' => '/collections'],
])

<section class="hero-banner">
    <img src="{{ $image }}" alt="BeFit — Achieving Wellness" class="hero-banner-img">
</section>

<div class="hero-cta-strip">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h5 class="mb-1">{{ $tag }}</h5>
            <div class="hero-cta-tag">{{ $text }}</div>
        </div>
        <div>
            <a href="{{ url($primaryCta['url']) }}" class="btn btn-main">{{ $primaryCta['label'] }}</a>
            <a href="{{ url($secondaryCta['url']) }}" class="btn btn-outline-custom">{{ $secondaryCta['label'] }}</a>
        </div>
    </div>
</div>

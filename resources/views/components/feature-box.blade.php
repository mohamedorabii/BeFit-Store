@props([
    'icon' => 'fa-solid fa-shield',
    'title' => 'Feature',
    'text' => '',
])

<div class="feature-box">
    <i class="{{ $icon }}"></i>
    <h4>{{ $title }}</h4>
    <p>{{ $text }}</p>
</div>

@extends('layouts.app')

@section('title', 'FAQ — BeFit')

@section('content')

    <div class="page-header-simple">
        <div class="container">
            <h1>Frequently Asked Questions</h1>
        </div>
    </div>

    <div class="container static-content" style="max-width:820px;">

        <div class="accordion" id="faqAccordion">
            @foreach ($faqs as $i => $faq)
                <div class="faq-item accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $i === 0 ? '' : 'collapsed' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq-{{ $i }}">
                            {{ $faq['question'] }}
                        </button>
                    </h2>
                    <div id="faq-{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">{{ $faq['answer'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection

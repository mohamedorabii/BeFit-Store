@extends('layouts.app')

@section('title', 'Contact Us — BeFit')

@section('content')

    <div class="page-header-simple">
        <div class="container">
            <h1>Get in Touch</h1>
        </div>
    </div>

    <div class="container static-content">

        @if (session('sent'))
            <div class="alert-success">Thanks — we'll get back to you within 1 business day.</div>
        @endif

        <div class="contact-grid">

            <div>
                <p class="lead-text" style="margin-bottom:16px;">
                    Questions about an order, sizing, or a bulk / team request? Send us a message
                    and a real person on the BeFit team will reply.
                </p>

                <ul class="contact-info-list">
                    <li>
                        <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="M22 6l-10 7L2 6"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg></div>
                        <div><b>Email</b><span>support@befit.example</span></div>
                    </li>
                    <li>
                        <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3.1-8.7A2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.7a2 2 0 01-.5 2.1L8 9.7a16 16 0 006 6l1.2-1.2a2 2 0 012.1-.5c.9.3 1.8.5 2.7.6a2 2 0 011.7 2z"/></svg></div>
                        <div><b>Phone</b><span>+20 100 000 0000</span></div>
                    </li>
                    <li>
                        <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 12-9 12s-9-5-9-12a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                        <div><b>Location</b><span>Beni Suef, Egypt</span></div>
                    </li>
                </ul>
            </div>

            <form action="{{ url('/contact') }}" method="POST">
                @csrf
                <div class="checkout-form-block">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-main" style="border:none;">Send Message</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection

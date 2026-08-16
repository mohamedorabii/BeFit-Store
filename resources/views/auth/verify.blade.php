@extends('layouts.app')

@section('title', 'Verify email — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card auth-card-message">
            <div class="auth-icon"><i class="fa-regular fa-envelope"></i></div>
            <p class="auth-kicker">ONE LAST STEP</p>
            <h1>Verify your email</h1>
            @if (session('resent')) <div class="auth-notice">A fresh verification link has been sent to your email address.</div> @endif
            <p class="auth-subtitle">Check your inbox and follow the verification link to finish setting up your account.</p>
            <form method="POST" action="{{ route('verification.resend') }}" class="auth-form">
                @csrf
                <button class="btn-main w-100 border-0" type="submit">Resend verification email</button>
            </form>
        </div>
    </section>
@endsection

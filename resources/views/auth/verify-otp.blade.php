@extends('layouts.app')

@section('title', 'Verify OTP — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card auth-card-message">
            <div class="auth-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <p class="auth-kicker">ONE MORE STEP</p>
            <h1>Enter your verification code</h1>

            @if (session('status'))
                <div class="auth-notice">{{ session('status') }}</div>
            @endif

            @if (session('info'))
                <div class="auth-notice">{{ session('info') }}</div>
            @endif

            <p class="auth-subtitle">We sent a 6-digit code to your email. Enter it below to activate your account.</p>

            <form method="POST" action="{{ route('otp.verify') }}" class="auth-form">
                @csrf

                <label for="code">Verification code</label>
                <input id="code" name="code" type="text" inputmode="numeric" maxlength="6" autocomplete="one-time-code" required autofocus value="{{ old('code') }}">
                @error('code') <small class="auth-error">{{ $message }}</small> @enderror

                <button class="btn-main w-100 border-0" type="submit">Verify account</button>
            </form>

            <form method="POST" action="{{ route('otp.send') }}" class="auth-form" style="margin-top: 12px;">
                @csrf
                <button class="btn-main w-100 border-0" type="submit">Resend code</button>
            </form>
        </div>
    </section>
@endsection
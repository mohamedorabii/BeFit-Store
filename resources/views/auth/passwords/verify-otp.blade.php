@extends('layouts.app')

@section('title', 'Verify reset code — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card auth-card-message">
            <div class="auth-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <p class="auth-kicker">ACCOUNT RECOVERY</p>
            <h1>Enter your reset code</h1>
            @if (session('status')) <div class="auth-notice">{{ session('status') }}</div> @endif
            <p class="auth-subtitle">We sent a 6-digit code to your email. It expires in 10 minutes.</p>
            <form method="POST" action="{{ route('password.otp.verify') }}" class="auth-form">
                @csrf
                <label for="code">Reset code</label>
                <input id="code" name="code" type="text" inputmode="numeric" maxlength="6" autocomplete="one-time-code" value="{{ old('code') }}" required autofocus>
                @error('code') <small class="auth-error">{{ $message }}</small> @enderror
                <button class="btn-main w-100 border-0" type="submit">Verify code</button>
            </form>
            <p class="auth-switch"><a href="{{ route('password.request') }}">Use another email</a></p>
        </div>
    </section>
@endsection

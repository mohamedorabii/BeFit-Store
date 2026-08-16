@extends('layouts.app')

@section('title', 'Reset password — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card">
            <p class="auth-kicker">ACCOUNT RECOVERY</p>
            <h1>Reset your password</h1>
            <p class="auth-subtitle">Enter your email and we'll send you a 6-digit reset code.</p>
            @if (session('status')) <div class="auth-notice">{{ session('status') }}</div> @endif
            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                @error('email') <small class="auth-error">{{ $message }}</small> @enderror
                <button class="btn-main w-100 border-0" type="submit">Send reset code</button>
            </form>
            <p class="auth-switch"><a href="{{ route('login') }}">← Back to sign in</a></p>
        </div>
    </section>
@endsection

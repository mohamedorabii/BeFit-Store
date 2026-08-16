@extends('layouts.app')

@section('title', 'Sign in — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card">
            <p class="auth-kicker">WELCOME BACK</p>
            <h1>Sign in to BeFit</h1>
            <p class="auth-subtitle">Pick up right where you left off.</p>
            <a href="{{ route('social.redirect', 'google') }}" class="social-auth-btn social-auth-btn-google">
                <span class="social-auth-icon" aria-hidden="true"><i class="fa-brands fa-google"></i></span>
                <span class="social-auth-text">
                    <strong>Continue with Google</strong>
                    <small>Fast sign in with your Google account</small>
                </span>
            </a>

            <div class="auth-divider"><span>or use your email</span></div>

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                @error('email') <small class="auth-error">{{ $message }}</small> @enderror
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
                @error('password') <small class="auth-error">{{ $message }}</small> @enderror
                <div class="auth-options">
                    <label class="remember-me"><input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>
                <button class="btn-main w-100 border-0" type="submit">Sign in</button>
            </form>
            <p class="auth-switch">New to BeFit? <a href="{{ route('register') }}">Create an account</a></p>
        </div>
    </section>
@endsection

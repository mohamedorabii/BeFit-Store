@extends('layouts.app')

@section('title', 'Create account — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card">
            <p class="auth-kicker">JOIN BEFIT</p>
            <h1>Create your account</h1>
            <p class="auth-subtitle">Your next workout essential is one step away.</p>
            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf
                <label for="name">Full name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>
                @error('name') <small class="auth-error">{{ $message }}</small> @enderror
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
                @error('email') <small class="auth-error">{{ $message }}</small> @enderror
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required>
                @error('password') <small class="auth-error">{{ $message }}</small> @enderror
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
                <button class="btn-main w-100 border-0" type="submit">Create account</button>
            </form>
            <p class="auth-switch">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </section>
@endsection

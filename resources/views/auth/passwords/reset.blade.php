@extends('layouts.app')

@section('title', 'Choose a new password — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card">
            <p class="auth-kicker">ACCOUNT RECOVERY</p>
            <h1>Choose a new password</h1>
            <p class="auth-subtitle">Your code is verified. Create a strong new password.</p>
            @if (session('status')) <div class="auth-notice">{{ session('status') }}</div> @endif
            <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                @csrf
                <label for="password">New password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required autofocus>
                @error('password') <small class="auth-error">{{ $message }}</small> @enderror
                <label for="password-confirm">Confirm new password</label>
                <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required>
                <button class="btn-main w-100 border-0" type="submit">Reset password</button>
            </form>
        </div>
    </section>
@endsection

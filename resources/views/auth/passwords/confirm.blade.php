@extends('layouts.app')

@section('title', 'Confirm password — BeFit')

@section('content')
    <section class="auth-page">
        <div class="auth-card">
            <p class="auth-kicker">SECURITY CHECK</p>
            <h1>Confirm your password</h1>
            <p class="auth-subtitle">For your security, please enter your password before continuing.</p>
            <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
                @csrf
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required autofocus>
                @error('password') <small class="auth-error">{{ $message }}</small> @enderror
                <button class="btn-main w-100 border-0" type="submit">Confirm password</button>
            </form>
        </div>
    </section>
@endsection

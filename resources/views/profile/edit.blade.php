@extends('layouts.app')

@section('title', 'My profile — BeFit')

@section('content')
    <section class="profile-page">
        <div class="container">
            <div class="profile-card">
                <div class="profile-intro">
                    <p class="auth-kicker">MY ACCOUNT</p>
                    <h1>Your profile</h1>
                    <p>Keep your personal details up to date for a smoother BeFit experience.</p>
                </div>

                @if (session('status'))
                    <div class="auth-notice">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="profile-fields">
                        <div>
                            <label for="name">Full name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" autocomplete="name" required>
                            @error('name') <small class="auth-error">{{ $message }}</small> @enderror
                        </div>
                        <div>
                            <label for="email">Email address</label>
                            <input id="email" type="email" value="{{ $user->email }}" disabled>
                            <small class="field-help">Your email address cannot be changed.</small>
                        </div>
                        <div>
                            <label for="phone">Phone number <span>(optional)</span></label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" autocomplete="tel">
                            @error('phone') <small class="auth-error">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="profile-actions">
                        <button class="btn-main border-0" type="submit">Save changes</button>
                        <button class="profile-logout" form="logout-form" type="submit">Sign out</button>
                    </div>
                </form>
                <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
            </div>
        </div>
    </section>
@endsection

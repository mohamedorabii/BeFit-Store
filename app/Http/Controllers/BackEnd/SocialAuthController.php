<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Services\SocialAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    private const SUPPORTED_PROVIDERS = ['google'];

    public function __construct(protected SocialAuthService $socialAuthService) {}

    public function redirect(string $provider): RedirectResponse
    {
        if (! in_array($provider, self::SUPPORTED_PROVIDERS, true)) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request, string $provider): RedirectResponse
    {
        if (! in_array($provider, self::SUPPORTED_PROVIDERS, true)) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Failed to authenticate with '.ucfirst($provider).'. Please try again.');
        }

        $user = $this->socialAuthService->findOrCreate($provider, $socialUser);

        if (! $user->is_active) {
            return redirect()->route('login')
                ->withErrors(['email' => 'This account has been disabled.']);
        }

        Auth::login($user, remember: true);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('status', 'Signed in with '.ucfirst($provider).' successfully.');
    }
}
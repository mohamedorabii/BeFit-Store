<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PasswordResetOtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class PasswordResetOtpController extends Controller
{
    private const VERIFICATION_WINDOW_MINUTES = 10;

    public function __construct(protected PasswordResetOtpService $otpService) {}

    public function create(): View
    {
        return view('auth.passwords.email');
    }

    public function send(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $throttleKey = 'password-reset-otp:'.strtolower($data['email']).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()->withErrors([
                'email' => "Too many requests. Please try again in {$seconds} seconds.",
            ]);
        }

        RateLimiter::hit($throttleKey, 60); // max 3 requests per minute per email+ip

        $user = User::where('email', $data['email'])->first();

        if ($user && $user->is_active) {
            $this->otpService->generateAndSend($user);

            $request->session()->put('password_reset_user_id', $user->id);
            $request->session()->forget('password_reset_verified_at');
        }

        // Always return the same response to avoid leaking whether the email exists.
        return redirect()->route('password.otp.show')
            ->with('status', 'If an account exists for that email, we sent a 6-digit reset code.');
    }

    public function showOtp(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('password_reset_user_id')) {
            return redirect()->route('password.request');
        }

        return view('auth.passwords.verify-otp');
    }

    public function verify(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $this->resolveSessionUser($request);

        if (! $user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please request a new reset code.']);
        }

        $result = $this->otpService->verify($user, $data['code']);

        if (! $result['success']) {
            return back()->withErrors(['code' => $result['message']]);
        }

        $request->session()->put('password_reset_verified_at', now());
        $request->session()->regenerate();
        $request->session()->put('password_reset_user_id', $user->id);

        return redirect()->route('password.reset')->with('status', $result['message']);
    }

    public function showResetForm(Request $request): View|RedirectResponse
    {
        if (! $this->hasValidVerificationWindow($request)) {
            return redirect()->route('password.request');
        }

        return view('auth.passwords.reset');
    }

    public function reset(Request $request): RedirectResponse
    {
        if (! $this->hasValidVerificationWindow($request)) {
            return redirect()->route('password.request');
        }

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $this->resolveSessionUser($request);

        if (! $user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please request a new reset code.']);
        }

        $this->otpService->resetPassword($user, $data['password']);

        $request->session()->forget(['password_reset_user_id', 'password_reset_verified_at']);
        $request->session()->regenerate();

        return redirect()->route('login')->with('status', 'Your password has been reset. You can now sign in.');
    }

    /**
     * Resolve the user tied to the current password-reset session.
     */
    private function resolveSessionUser(Request $request): ?User
    {
        $userId = $request->session()->get('password_reset_user_id');

        return $userId ? User::find($userId) : null;
    }

    /**
     * Check the OTP was verified and the verification window hasn't expired.
     */
    private function hasValidVerificationWindow(Request $request): bool
    {
        $verifiedAt = $request->session()->get('password_reset_verified_at');

        if (! $verifiedAt) {
            return false;
        }

        return now()->diffInMinutes($verifiedAt) <= self::VERIFICATION_WINDOW_MINUTES;
    }
}
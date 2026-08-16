<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOtpRequest;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OtpController extends Controller
{
    public function __construct(protected OtpService $otpService) {}

    public function show(): View
    {
        return view('auth.verify-otp');
    }

    public function send(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->email_verified_at) {
            return redirect()->route('home')->with('info', 'Account already verified.');
        }

        $result = $this->otpService->generateAndSendEmailVerification($user);

        if (! $result['success']) {
            return back()->withErrors(['code' => $result['message']]);
        }

        return back()->with('status', $result['message']);
    }

    public function verify(VerifyOtpRequest $request): RedirectResponse
    {
        $result = $this->otpService->verifyEmail($request->user(), $request->validated('code'));

        if (! $result['success']) {
            return back()->withErrors(['code' => $result['message']]);
        }

        return redirect()->route('home')->with('status', $result['message']);
    }
}

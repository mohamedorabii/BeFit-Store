<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOtpRequest;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function __construct(protected OtpService $otpService) {}

    public function show(): \Illuminate\View\View
    {
        return view('auth.verify-otp');
    }

    public function send(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->email_verified_at) {
            return redirect()->route('home')->with('info', 'Account already verified.');
        }

        $this->otpService->generateAndSend($user);

        return back()->with('status', 'A verification code has been sent to your email.');
    }

    public function verify(VerifyOtpRequest $request): RedirectResponse
    {
        $result = $this->otpService->verify($request->user(), $request->validated('code'));

        if (! $result['success']) {
            return back()->withErrors(['code' => $result['message']]);
        }

        return redirect()->route('home')->with('status', $result['message']);
    }
}

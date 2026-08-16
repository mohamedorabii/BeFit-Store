<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\SendOtpNotification;

class OtpService
{
    public function generateAndSend(User $user): void
    {
        $code = (string) random_int(100000, 999999);

        $user->forceFill([
            'otp_code' => $code,
            'otp_expires_at' => now()->addMinutes(10),
            'otp_attempts' => 0,
        ])->save();

        $user->notify(new SendOtpNotification($code));
    }

    public function verify(User $user, string $code): array
    {
        if (! $user->otp_code) {
            return ['success' => false, 'message' => 'No valid code found, please request a new one.'];
        }

        if ($user->otp_expires_at->isPast()) {
            return ['success' => false, 'message' => 'Code has expired, please request a new one.'];
        }

        if ($user->otp_attempts >= 5) {
            return ['success' => false, 'message' => 'Too many attempts, please request a new code.'];
        }

        if ($user->otp_code !== $code) {
            $user->increment('otp_attempts');
            return ['success' => false, 'message' => 'Invalid code.'];
        }

        $user->forceFill([
            'email_verified_at' => now(),
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_attempts' => 0,
        ])->save();

        return ['success' => true, 'message' => 'Account verified successfully.'];
    }
}

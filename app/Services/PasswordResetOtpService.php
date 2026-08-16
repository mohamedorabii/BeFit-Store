<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\SendPasswordResetOtpNotification;

class PasswordResetOtpService
{
    public function generateAndSend(User $user): void
    {
        $code = (string) random_int(100000, 999999);

        $user->forceFill([
            'otp_code' => $code,
            'otp_expires_at' => now()->addMinutes(10),
            'otp_attempts' => 0,
        ])->save();

        $user->notify(new SendPasswordResetOtpNotification($code));
    }

    public function verify(User $user, string $code): array
    {
        if (! $user->otp_code) {
            return ['success' => false, 'message' => 'No valid reset code found. Please request a new code.'];
        }

        if ($user->otp_expires_at->isPast()) {
            return ['success' => false, 'message' => 'This code has expired. Please request a new one.'];
        }

        if ($user->otp_attempts >= 5) {
            return ['success' => false, 'message' => 'Too many attempts. Please request a new code.'];
        }

        if (! hash_equals($user->otp_code, $code)) {
            $user->increment('otp_attempts');

            return ['success' => false, 'message' => 'Invalid code.'];
        }

        return ['success' => true, 'message' => 'Code verified. Choose a new password.'];
    }

    public function resetPassword(User $user, string $password): void
    {
        $user->forceFill([
            'password' => $password,
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_attempts' => 0,
            'remember_token' => null,
        ])->save();
    }
}

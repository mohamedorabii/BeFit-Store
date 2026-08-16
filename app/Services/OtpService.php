<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\SendOtpNotification;
use App\Notifications\SendPasswordResetOtpNotification;

class OtpService
{
    private const CODE_TTL_MINUTES = 10;

    private const MAX_ATTEMPTS = 5;

    public function generateAndSendEmailVerification(User $user): array
    {
        return $this->issue($user, fn (string $code) => new SendOtpNotification($code));
    }

    public function generateAndSendPasswordReset(User $user): array
    {
        return $this->issue($user, fn (string $code) => new SendPasswordResetOtpNotification($code));
    }

    public function verify(User $user, string $code): array
    {
        if (! $user->otp_code || ! $user->otp_expires_at) {
            return $this->failure('No valid code found. Please request a new code.');
        }

        if ($user->otp_expires_at->isPast()) {
            $this->clear($user);

            return $this->failure('This code has expired. Please request a new one.');
        }

        if ($user->otp_attempts >= self::MAX_ATTEMPTS) {
            $this->clear($user);

            return $this->failure('Too many attempts. Please request a new code.');
        }
        
        if (! hash_equals($user->otp_code, $code)) {
            $user->increment('otp_attempts');

            return $this->failure('Invalid code.');
        }

        return ['success' => true, 'message' => 'Code verified successfully.'];
    }

    public function verifyEmail(User $user, string $code): array
    {
        $result = $this->verify($user, $code);

        if (! $result['success']) {
            return $result;
        }

        $user->forceFill(['email_verified_at' => now()]);
        $this->clear($user);

        return ['success' => true, 'message' => 'Account verified successfully.'];
    }

    public function clear(User $user): void
    {
        $user->forceFill([
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_attempts' => 0,
        ])->save();
    }

    private function issue(User $user, callable $notificationFactory): array
    {
        $code = (string) random_int(100000, 999999);

        $user->forceFill([
            'otp_code' => $code,
            'otp_expires_at' => now()->addMinutes(self::CODE_TTL_MINUTES),
            'otp_attempts' => 0,
        ])->save();

        $user->notify($notificationFactory($code));

        return ['success' => true, 'message' => 'A verification code has been sent to your email.'];
    }

    private function failure(string $message): array
    {
        return ['success' => false, 'message' => $message];
    }
}

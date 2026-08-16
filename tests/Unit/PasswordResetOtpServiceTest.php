<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\PasswordResetOtpService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordResetOtpServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_valid_code_allows_the_password_to_be_reset(): void
    {
        $user = User::factory()->create([
            'otp_code' => '123456',
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        $service = app(PasswordResetOtpService::class);
        $result = $service->verify($user, '123456');
        $service->resetPassword($user, 'new-password123');

        $freshUser = $user->fresh();
        $this->assertTrue($result['success']);
        $this->assertTrue(Hash::check('new-password123', $freshUser->password));
        $this->assertNull($freshUser->otp_code);
    }
}

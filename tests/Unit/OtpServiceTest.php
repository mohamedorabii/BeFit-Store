<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\OtpService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OtpServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_valid_otp_verifies_the_user_and_clears_the_code(): void
    {
        $user = User::factory()->unverified()->create([
            'otp_code' => '123456',
            'otp_expires_at' => now()->addMinutes(10),
            'otp_attempts' => 0,
        ]);

        $result = app(OtpService::class)->verifyEmail($user, '123456');

        $this->assertTrue($result['success']);
        $this->assertNotNull($user->fresh()->email_verified_at);
        $this->assertNull($user->fresh()->otp_code);
    }
}

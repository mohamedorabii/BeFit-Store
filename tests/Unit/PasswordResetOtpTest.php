<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\OtpService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordResetOtpTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_valid_otp_can_be_used_to_reset_a_password(): void
    {
        $user = User::factory()->create([
            'otp_code' => '123456',
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        $result = app(OtpService::class)->verify($user, '123456');
        $user->forceFill(['password' => 'new-password123'])->save();
        app(OtpService::class)->clear($user);

        $this->assertTrue($result['success']);
        $this->assertTrue(Hash::check('new-password123', $user->fresh()->password));
        $this->assertNull($user->fresh()->otp_code);
    }
}

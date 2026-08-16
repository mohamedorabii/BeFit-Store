<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialAuthService
{
    
    public function findOrCreate(string $provider, SocialiteUser $socialUser): User
    {
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            $user->forceFill([
                'name' => $socialUser->getName() ?? $user->name,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->save();

            return $user;
        }

        return User::create([
            'name' => $socialUser->getName() ?? $socialUser->getNickname(),
            'email' => $socialUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'password' => Hash::make(Str::random(32)),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
    }
}
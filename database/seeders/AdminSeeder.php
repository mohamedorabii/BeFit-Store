<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'Orabii',
            'email' => 'admin@befit.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
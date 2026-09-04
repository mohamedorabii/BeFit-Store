<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
  public function run(): void
{
    $this->call([
        AdminSeeder::class,
        CategorySeeder::class,
        SubcategorySeeder::class,
        ColorSeeder::class,
        SizeSeeder::class,
        ProductSeeder::class,
    ]);
}
}

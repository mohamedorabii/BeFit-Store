<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategorySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_seeded(): void
    {
        $this->artisan('db:seed', ['--class' => CategorySeeder::class]);

        $this->assertDatabaseCount('categories', 6);
        $this->assertDatabaseHas('categories', ['status' => true]);
        $this->assertTrue(Category::query()->exists());
    }
}

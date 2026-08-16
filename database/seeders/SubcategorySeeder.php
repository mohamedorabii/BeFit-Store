<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::query()
            ->get()
            ->each(function (Category $category) {
                Subcategory::factory()
                    ->count(4)
                    ->create([
                        'category_id' => $category->id,
                    ]);
            });
    }
}
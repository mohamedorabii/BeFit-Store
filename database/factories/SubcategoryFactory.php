<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Subcategory>
 */
class SubcategoryFactory extends Factory
{
    protected $model = Subcategory::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'category_id' => Category::factory(),

            'name_en' => ucwords($name),
            'name_ar' => $name,

            'slug' => Str::slug($name),

            'image' => null,

            'status' => true,

            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
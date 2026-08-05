<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->word();

        return [
            'name_en'    => ucfirst($name),
            'name_ar'    => ucfirst($name),
            'slug'       => Str::slug($name),
            'image'      => null,
            'status'     => true,
            'sort_order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
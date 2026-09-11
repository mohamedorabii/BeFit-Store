<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $subcategories = [
            'men' => [
                ['name_en' => 'T-Shirts', 'name_ar' => 'تيشيرتات', 'image' => 'subcategories/01M26XE3XEC8X0M9SP8FF13619.jpg'],
                ['name_en' => 'Hoodies', 'name_ar' => 'هوديز', 'image' => 'subcategories/01M26XE4723NY3S69V4S7YQ8S9.jpg'],
                ['name_en' => 'Jackets', 'name_ar' => 'جاكيتات', 'image' => 'subcategories/01M26XE4EQ8YW1QX1WMZFQJP3F.jpg'],
            ],
            'women' => [
                ['name_en' => 'Leggings', 'name_ar' => 'ليجنز', 'image' => 'subcategories/01M26XE4PQWQVBZ4RCP1FAFDJ5.jpg'],
                ['name_en' => 'Sports Bras', 'name_ar' => 'حمالات رياضية', 'image' => 'categories/01M26XE2AWCWM6BTG6W17AT2VP.jpg'],
                ['name_en' => 'Jackets', 'name_ar' => 'جاكيتات', 'image' => 'subcategories/01M26XE4EQ8YW1QX1WMZFQJP3F.jpg'],
            ],
            'shoes' => [
                ['name_en' => 'Sneakers', 'name_ar' => 'سنيكرز', 'image' => 'categories/01M26XE2FXA8DPYJZV9SCAR7DM.jpg'],
                ['name_en' => 'Running Shoes', 'name_ar' => 'أحذية جري', 'image' => 'categories/01M26XE2FXA8DPYJZV9SCAR7DM.jpg'],
            ],
            'accessories' => [
                ['name_en' => 'Bags', 'name_ar' => 'شنط', 'image' => 'categories/01M26XE3GXBZMZHJ4SYTHJB3GZ.jpg'],
                ['name_en' => 'Caps', 'name_ar' => 'كابات', 'image' => 'categories/01M26XE2X3WCYR0458FSTK16W3.jpg'],
            ],
            'outerwear' => [
                ['name_en' => 'Jackets', 'name_ar' => 'جاكيتات', 'image' => 'subcategories/01M26XE4EQ8YW1QX1WMZFQJP3F.jpg'],
                ['name_en' => 'Coats', 'name_ar' => 'معاطف', 'image' => 'categories/01M26XE2NXW1Q49AY9J6JFNE86.jpg'],
            ],
        ];

        foreach ($subcategories as $categorySlug => $items) {
            $category = Category::where('slug', $categorySlug)->first();

            if (! $category) {
                continue;
            }

            foreach ($items as $index => $item) {
                Subcategory::create([
                    ...$item,
                    'category_id' => $category->id,
                    'slug' => Str::slug($category->slug . '-' . $item['name_en']),
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
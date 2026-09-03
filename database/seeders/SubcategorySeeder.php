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
                ['name_en' => 'T-Shirts', 'name_ar' => 'تيشيرتات', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=900&auto=format&fit=crop'],
                ['name_en' => 'Hoodies', 'name_ar' => 'هوديز', 'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=900&auto=format&fit=crop'],
                ['name_en' => 'Jackets', 'name_ar' => 'جاكيتات', 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=900&auto=format&fit=crop'],
            ],
            'women' => [
                ['name_en' => 'Leggings', 'name_ar' => 'ليجنز', 'image' => 'https://images.unsplash.com/photo-1506629082955-511b1aa562c8?q=80&w=900&auto=format&fit=crop'],
                ['name_en' => 'Sports Bras', 'name_ar' => 'حمالات رياضية', 'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop'],
                ['name_en' => 'Jackets', 'name_ar' => 'جاكيتات', 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=900&auto=format&fit=crop'],
            ],
            'shoes' => [
                ['name_en' => 'Sneakers', 'name_ar' => 'سنيكرز', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop'],
                ['name_en' => 'Running Shoes', 'name_ar' => 'أحذية جري', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop'],
            ],
            'accessories' => [
                ['name_en' => 'Bags', 'name_ar' => 'شنط', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=900&auto=format&fit=crop'],
                ['name_en' => 'Caps', 'name_ar' => 'كابات', 'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=900&auto=format&fit=crop'],
            ],
            'outerwear' => [
                ['name_en' => 'Jackets', 'name_ar' => 'جاكيتات', 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=900&auto=format&fit=crop'],
                ['name_en' => 'Coats', 'name_ar' => 'معاطف', 'image' => 'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?q=80&w=900&auto=format&fit=crop'],
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
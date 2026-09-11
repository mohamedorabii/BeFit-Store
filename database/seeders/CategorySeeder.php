<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Men',
                'name_ar' => 'رجالي',
                'image' => 'categories/01M26XE22D3X5GV9AHZ7AQK2MX.jpg',
            ],
            [
                'name_en' => 'Women',
                'name_ar' => 'حريمي',
                'image' => 'categories/01M26XE2AWCWM6BTG6W17AT2VP.jpg',
            ],
            [
                'name_en' => 'Shoes',
                'name_ar' => 'أحذية',
                'image' => 'categories/01M26XE2FXA8DPYJZV9SCAR7DM.jpg',
            ],
            [
                'name_en' => 'Accessories',
                'name_ar' => 'إكسسوارات',
                'image' => 'categories/01M26XE2AWCWM6BTG6W17AT2VP.jpg',
            ],
            [
                'name_en' => 'Outerwear',
                'name_ar' => 'ملابس خارجية',
                'image' => 'categories/01M26XE2NXW1Q49AY9J6JFNE86.jpg',
            ],
            [
                'name_en' => 'New Arrivals',
                'name_ar' => 'وصل حديثاً',
                'image' => 'categories/01M26XE2X3WCYR0458FSTK16W3.jpg',
            ],
            [
                'name_en' => 'Sportswear',
                'name_ar' => 'ملابس رياضية',
                'image' => 'categories/01M26XE33P2JP6FSZQM1X7D2KV.jpg',
            ],
            [
                'name_en' => 'Kids',
                'name_ar' => 'أطفال',
                'image' => 'categories/01M26XE38VK783DRCXTJ92BM41.jpg',
            ],
            [
                'name_en' => 'Bags',
                'name_ar' => 'شنط',
                'image' => 'categories/01M26XE3GXBZMZHJ4SYTHJB3GZ.jpg',
            ],
            [
                'name_en' => 'Fitness Gear',
                'name_ar' => 'معدات لياقة',
                'image' => 'categories/01M26XE3PYRVGGJS7ZSA6YG2AE.jpg',
            ],
        ];

        foreach ($categories as $index => $category) {
            Category::create([
                ...$category,
                'slug' => Str::slug($category['name_en']),
                'sort_order' => $index,
            ]);
        }
    }
}
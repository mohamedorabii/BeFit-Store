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
                'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Women',
                'name_ar' => 'حريمي',
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Shoes',
                'name_ar' => 'أحذية',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Accessories',
                'name_ar' => 'إكسسوارات',
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Outerwear',
                'name_ar' => 'ملابس خارجية',
                'image' => 'https://images.unsplash.com/photo-1509942774463-acf339cf87d5?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'New Arrivals',
                'name_ar' => 'وصل حديثاً',
                'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Sportswear',
                'name_ar' => 'ملابس رياضية',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Kids',
                'name_ar' => 'أطفال',
                'image' => 'https://images.unsplash.com/photo-1503919545889-aef636e10ad4?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Bags',
                'name_ar' => 'شنط',
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=900&auto=format&fit=crop',
            ],
            [
                'name_en' => 'Fitness Gear',
                'name_ar' => 'معدات لياقة',
                'image' => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?q=80&w=900&auto=format&fit=crop',
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
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $colorIds = Color::pluck('id', 'name_en');
        $sizeIds = Size::pluck('id', 'name_en');

        $products = [
            [
                'category' => 'men',
                'subcategory' => 'men-t-shirts',
                'name_en' => 'Performance Tee',
                'name_ar' => 'تيشيرت رياضي',
                'price' => 450,
                'old_price' => 550,
                'badge' => 'Sale',
                'image' => 'subcategories/01M26XE3XEC8X0M9SP8FF13619.jpg',
            ],
            [
                'category' => 'men',
                'subcategory' => 'men-hoodies',
                'name_en' => 'Fleece Hoodie',
                'name_ar' => 'هودي فليس',
                'price' => 780,
                'old_price' => null,
                'badge' => 'New',
                'image' => 'subcategories/01M26XE4723NY3S69V4S7YQ8S9.jpg',
            ],
            [
                'category' => 'women',
                'subcategory' => 'women-leggings',
                'name_en' => 'High-Waist Leggings',
                'name_ar' => 'ليجن عالي الخصر',
                'price' => 520,
                'old_price' => null,
                'badge' => null,
                'image' => 'subcategories/01M26XE4PQWQVBZ4RCP1FAFDJ5.jpg',
            ],
            [
                'category' => 'women',
                'subcategory' => 'women-sports-bras',
                'name_en' => 'Seamless Sports Bra',
                'name_ar' => 'حمالة رياضية',
                'price' => 380,
                'old_price' => 420,
                'badge' => 'Sale',
                'image' => 'categories/01M26XE2AWCWM6BTG6W17AT2VP.jpg',
            ],
            [
                'category' => 'shoes',
                'subcategory' => 'shoes-sneakers',
                'name_en' => 'Street Runner Sneakers',
                'name_ar' => 'سنيكرز رياضي',
                'price' => 1250,
                'old_price' => null,
                'badge' => 'Best Seller',
                'image' => 'categories/01M26XE2FXA8DPYJZV9SCAR7DM.jpg',
            ],
            [
                'category' => 'outerwear',
                'subcategory' => 'outerwear-jackets',
                'name_en' => 'Windbreaker Jacket',
                'name_ar' => 'جاكيت واقي من الرياح',
                'price' => 950,
                'old_price' => null,
                'badge' => 'New',
                'image' => 'subcategories/01M26XE4EQ8YW1QX1WMZFQJP3F.jpg',
            ],
            [
                'category' => 'women',
                'subcategory' => 'women-leggings',
                'name_en' => 'Compression Leggings',
                'name_ar' => 'ليجن ضاغط',
                'price' => 495,
                'old_price' => 600,
                'badge' => 'Sale',
                'image' => 'products/gallery/01M26XE4X6H3VMJPNRHV3Z22VC.jpg',
            ],
            [
                'category' => 'accessories',
                'subcategory' => 'accessories-caps',
                'name_en' => 'Training Cap',
                'name_ar' => 'كاب رياضي',
                'price' => 190,
                'old_price' => null,
                'badge' => null,
                'image' => 'products/gallery/01M26XE55EVM5EGF7Z3BF3KZPT.jpg',
            ],
            [
                'category' => 'accessories',
                'subcategory' => 'accessories-bags',
                'name_en' => 'Gym Duffel Bag',
                'name_ar' => 'شنطة جيم',
                'price' => 490,
                'old_price' => null,
                'badge' => 'New',
                'image' => 'categories/01M26XE3GXBZMZHJ4SYTHJB3GZ.jpg',
            ],
            [
                'category' => 'men',
                'subcategory' => 'men-t-shirts',
                'name_en' => 'Tank Top',
                'name_ar' => 'فانلة رياضية',
                'price' => 250,
                'old_price' => 350,
                'badge' => 'Sale',
                'image' => 'products/gallery/01M26XE5AHBPD255EENVAW5YYQ.jpg',
            ],
            [
                'category' => 'shoes',
                'subcategory' => 'shoes-running-shoes',
                'name_en' => 'Trail Running Shoes',
                'name_ar' => 'حذاء جري للطرق الوعرة',
                'price' => 1350,
                'old_price' => 1600,
                'badge' => 'Sale',
                'image' => 'products/gallery/01M26XE5GVQYKMFS74E9EZ2V8M.jpg',
            ],
            [
                'category' => 'outerwear',
                'subcategory' => 'outerwear-coats',
                'name_en' => 'Insulated Winter Coat',
                'name_ar' => 'معطف شتوي مبطن',
                'price' => 1450,
                'old_price' => null,
                'badge' => 'New',
                'image' => 'products/gallery/01M26XE5Q67211N3BQPDQT6B5S.jpg',
            ],
        ];

        $variantColors = ['Black', 'White', 'Navy'];
        $variantSizes = ['S', 'M', 'L', 'XL'];

        foreach ($products as $item) {
            $category = Category::where('slug', $item['category'])->first();
            $subcategory = Subcategory::where('slug', $item['subcategory'])->first();

            if (! $category) {
                continue;
            }

            $product = Product::create([
                'category_id' => $category->id,
                'subcategory_id' => $subcategory?->id,
                'name_en' => $item['name_en'],
                'name_ar' => $item['name_ar'],
                'slug' => Str::slug($item['name_en']),
                'price' => $item['price'],
                'old_price' => $item['old_price'],
                'badge' => $item['badge'],
            ]);

            $product->images()->create([
                'image' => $item['image'],
                'is_primary' => true,
                'sort_order' => 0,
            ]);

            foreach ($variantColors as $colorName) {
                foreach ($variantSizes as $sizeName) {
                    $product->variants()->create([
                        'color_id' => $colorIds[$colorName],
                        'size_id' => $sizeIds[$sizeName],
                        'stock' => rand(5, 30),
                        'sku' => strtoupper(Str::slug($item['name_en'], '')) . '-' . $colorName[0] . '-' . $sizeName,
                    ]);
                }
            }
        }
    }
}
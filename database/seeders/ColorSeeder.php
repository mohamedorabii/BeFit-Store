<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['name_en' => 'Black', 'name_ar' => 'أسود', 'hex_code' => '#000000'],
            ['name_en' => 'White', 'name_ar' => 'أبيض', 'hex_code' => '#FFFFFF'],
            ['name_en' => 'Navy', 'name_ar' => 'كحلي', 'hex_code' => '#1B2A4A'],
            ['name_en' => 'Grey', 'name_ar' => 'رمادي', 'hex_code' => '#808080'],
            ['name_en' => 'Red', 'name_ar' => 'أحمر', 'hex_code' => '#D32F2F'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
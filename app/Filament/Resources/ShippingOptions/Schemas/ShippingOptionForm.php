<?php

namespace App\Filament\Resources\ShippingOptions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ShippingOptionForm
{
      public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('governorate')
                    ->label('Governorate')
                    ->options([
                        'القاهرة' => 'القاهرة',
                        'الجيزة' => 'الجيزة',
                        'الإسكندرية' => 'الإسكندرية',
                        'الدقهلية' => 'الدقهلية',
                        'البحر الأحمر' => 'البحر الأحمر',
                        'البحيرة' => 'البحيرة',
                        'الفيوم' => 'الفيوم',
                        'الغربية' => 'الغربية',
                        'الإسماعيلية' => 'الإسماعيلية',
                        'المنوفية' => 'المنوفية',
                        'المنيا' => 'المنيا',
                        'القليوبية' => 'القليوبية',
                        'الوادي الجديد' => 'الوادي الجديد',
                        'السويس' => 'السويس',
                        'أسوان' => 'أسوان',
                        'أسيوط' => 'أسيوط',
                        'بني سويف' => 'بني سويف',
                        'بورسعيد' => 'بورسعيد',
                        'دمياط' => 'دمياط',
                        'الشرقية' => 'الشرقية',
                        'جنوب سيناء' => 'جنوب سيناء',
                        'كفر الشيخ' => 'كفر الشيخ',
                        'مطروح' => 'مطروح',
                        'الأقصر' => 'الأقصر',
                        'قنا' => 'قنا',
                        'شمال سيناء' => 'شمال سيناء',
                        'سوهاج' => 'سوهاج',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->searchable(),

                TextInput::make('price')
                    ->required()
                    ->minValue(0)
                    ->numeric()
                    ->prefix('EGP'),
            ]);
    }
}

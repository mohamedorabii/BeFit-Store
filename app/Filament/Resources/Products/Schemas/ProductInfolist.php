<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('primaryImage.image')
                    ->label('Image')
                    ->disk('public')
                    ->default('products/default.png'),

                TextEntry::make('category.name_en')
                    ->label('Category'),

                TextEntry::make('subcategory.name_en')
                    ->label('Subcategory')
                    ->placeholder('-'),

                TextEntry::make('name_en')
                    ->label('Name (English)'),

                TextEntry::make('name_ar')
                    ->label('Name (Arabic)'),

                TextEntry::make('slug'),

                TextEntry::make('description_en')
                    ->label('Description (English)')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('description_ar')
                    ->label('Description (Arabic)')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('price')
                    ->money('EGP'),

                TextEntry::make('old_price')
                    ->label('Old Price')
                    ->money('EGP')
                    ->placeholder('-'),

                TextEntry::make('badge')
                    ->placeholder('-'),

                TextEntry::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state == 1 ? 'Active' : 'Not Active')
                    ->badge()
                    ->color(fn ($state) => $state == 1 ? 'success' : 'danger'),

                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Product $record): bool => $record->trashed()),

                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
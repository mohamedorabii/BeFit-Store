<?php

namespace App\Filament\Resources\Subcategories\Schemas;

use App\Models\Subcategory;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubcategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.id')
                    ->label('Category'),
                TextEntry::make('name_en'),
                TextEntry::make('name_ar'),
                TextEntry::make('slug'),
                ImageEntry::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->default('subcategories/default.png'),
                IconEntry::make('status')
                    ->boolean(),
                TextEntry::make('sort_order')
                    ->numeric(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Subcategory $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

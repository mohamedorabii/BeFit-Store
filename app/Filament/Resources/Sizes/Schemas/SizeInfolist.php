<?php

namespace App\Filament\Resources\Sizes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SizeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name_en')
                    ->label('Name (English)'),

                TextEntry::make('name_ar')
                    ->label('Name (Arabic)'),

                TextEntry::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state == 1 ? 'Active' : 'Not Active')
                    ->badge()
                    ->color(fn ($state) => $state == 1 ? 'success' : 'danger'),

                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
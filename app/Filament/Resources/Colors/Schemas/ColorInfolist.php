<?php

namespace App\Filament\Resources\Colors\Schemas;

use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ColorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name_en')
                    ->label('Name (English)'),

                TextEntry::make('name_ar')
                    ->label('Name (Arabic)'),

                ColorEntry::make('swatch')
                    ->label('Color')
                    ->getStateUsing(fn ($record) => $record->hex_code),

                TextEntry::make('hex_code')
                    ->label('Hex Code')
                    ->placeholder('-'),

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
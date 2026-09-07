<?php

namespace App\Filament\Resources\Colors\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_en')
                    ->label('Name (English)')
                    ->required(),

                TextInput::make('name_ar')
                    ->label('Name (Arabic)')
                    ->required(),

                ColorPicker::make('hex_code')
                    ->label('Color')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Not Active',
                    ])
                    ->default(1)
                    ->required(),
            ]);
    }
}
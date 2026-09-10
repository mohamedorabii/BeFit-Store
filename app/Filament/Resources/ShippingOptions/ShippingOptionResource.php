<?php

namespace App\Filament\Resources\ShippingOptions;

use App\Filament\Resources\ShippingOptions\Pages\CreateShippingOption;
use App\Filament\Resources\ShippingOptions\Pages\EditShippingOption;
use App\Filament\Resources\ShippingOptions\Pages\ListShippingOptions;
use App\Filament\Resources\ShippingOptions\Pages\ViewShippingOption;
use App\Filament\Resources\ShippingOptions\Schemas\ShippingOptionForm;
use App\Filament\Resources\ShippingOptions\Schemas\ShippingOptionInfolist;
use App\Filament\Resources\ShippingOptions\Tables\ShippingOptionsTable;
use App\Models\ShippingOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShippingOptionResource extends Resource
{
    protected static ?string $model = ShippingOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'governorate';

    public static function form(Schema $schema): Schema
    {
        return ShippingOptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ShippingOptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShippingOptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShippingOptions::route('/'),
            'create' => CreateShippingOption::route('/create'),
            'view' => ViewShippingOption::route('/{record}'),
            'edit' => EditShippingOption::route('/{record}/edit'),
        ];
    }
}

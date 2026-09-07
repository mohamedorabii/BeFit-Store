<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Customer')
                    ->relationship('user', 'name')
                    ->disabled(),

                TextInput::make('order_number')
                    ->disabled(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),

                TextInput::make('name')
                    ->label('Customer Name')
                    ->disabled(),

                TextInput::make('phone')
                    ->tel()
                    ->disabled(),

                TextInput::make('address')
                    ->disabled(),

                TextInput::make('city')
                    ->disabled(),

                TextInput::make('governorate')
                    ->disabled(),

                TextInput::make('shipping_price')
                    ->numeric()
                    ->prefix('EGP')
                    ->disabled(),

                TextInput::make('total_price')
                    ->numeric()
                    ->prefix('EGP')
                    ->disabled(),

                Repeater::make('items')
                    ->relationship()
                    ->label('Order Items')
                    ->schema([
                        Select::make('product_id')
                            ->label('Product')
                            ->relationship('product', 'name_en')
                            ->disabled(),

                        TextInput::make('color_name_en')
                            ->label('Color')
                            ->disabled(),

                        TextInput::make('size_name_en')
                            ->label('Size')
                            ->disabled(),

                        TextInput::make('variant_sku')
                            ->label('SKU')
                            ->disabled(),

                        TextInput::make('quantity')
                            ->numeric()
                            ->disabled(),

                        TextInput::make('price')
                            ->numeric()
                            ->prefix('EGP')
                            ->disabled(),

                        TextInput::make('total_price')
                            ->label('Line Total')
                            ->numeric()
                            ->prefix('EGP')
                            ->disabled(),
                    ])
                    ->columns(4)
                    ->deletable(false)
                    ->addable(false)
                    ->columnSpanFull(),
            ]);
    }
}
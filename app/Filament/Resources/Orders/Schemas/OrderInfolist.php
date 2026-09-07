<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Info')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('order_number')
                            ->label('Order #'),

                        TextEntry::make('user.name')
                            ->label('Customer'),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'shipped' => 'info',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('total_price')
                            ->label('Total')
                            ->money('EGP'),

                        TextEntry::make('shipping_price')
                            ->label('Shipping')
                            ->money('EGP'),

                        TextEntry::make('created_at')
                            ->dateTime(),
                    ]),

                Section::make('Shipping Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Customer Name'),

                        TextEntry::make('phone'),

                        TextEntry::make('address')
                            ->columnSpanFull(),

                        TextEntry::make('city'),

                        TextEntry::make('governorate'),
                    ]),

                Section::make('Order Items')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('product.name_en')
                                    ->label('Product'),

                                TextEntry::make('color_name_en')
                                    ->label('Color'),

                                TextEntry::make('size_name_en')
                                    ->label('Size'),

                                TextEntry::make('variant_sku')
                                    ->label('SKU'),

                                TextEntry::make('quantity'),

                                TextEntry::make('price')
                                    ->money('EGP'),

                                TextEntry::make('total_price')
                                    ->label('Line Total')
                                    ->money('EGP'),
                            ])
                            ->columns(4),
                    ]),
            ]);
    }
}
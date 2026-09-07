<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name_en')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('subcategory_id', null))
                    ->required(),

                Select::make('subcategory_id')
                    ->label('Subcategory')
                    ->relationship(
                        'subcategory',
                        'name_en',
                        modifyQueryUsing: fn($query, Get $get) => $query->where('category_id', $get('category_id')),
                    )
                    ->searchable()
                    ->preload()
                    ->disabled(fn(Get $get) => ! $get('category_id'))
                    ->helperText('Select a category first'),

                TextInput::make('name_en')
                    ->label('Name (English)')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $state, Set $set) => $set('slug', Str::slug($state))),

                TextInput::make('name_ar')
                    ->label('Name (Arabic)')
                    ->required(),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('description_en')
                    ->label('Description (English)')
                    ->columnSpanFull(),

                Textarea::make('description_ar')
                    ->label('Description (Arabic)')
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('EGP'),

                TextInput::make('old_price')
                    ->label('Old Price')
                    ->numeric()
                    ->prefix('EGP'),

                TextInput::make('badge')
                    ->helperText('e.g. New, Sale, Best Seller'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Not Active',
                    ])
                    ->default(1)
                    ->required(),

                Repeater::make('images')
                    ->relationship()
                    ->label('Gallery Images')
                    ->live()
                    ->defaultItems(0)
                    ->afterStateUpdated(function (?array $state, Set $set) {
                        if (empty($state)) {
                            return;
                        }

                        $hasPrimary = collect($state)->contains(fn($item) => (bool) ($item['is_primary'] ?? false));

                        if (! $hasPrimary) {
                            $firstKey = array_key_first($state);
                            $set("images.{$firstKey}.is_primary", true);
                        }
                    })
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
                            ->disk('public')
                            ->directory('products/gallery')
                            ->image()
                            ->required(),

                        Toggle::make('is_primary')
                            ->label('Primary')
                            ->live()
                            ->afterStateUpdated(function (bool $state, Set $set, Get $get) {
                                $siblings = $get('../') ?? [];

                                if ($state) {
                                    foreach (array_keys($siblings) as $key) {
                                        $set("../{$key}.is_primary", false);
                                    }
                                    $set('is_primary', true);
                                    return;
                                }

                                $hasAnyPrimary = collect($siblings)
                                    ->contains(fn($item) => (bool) ($item['is_primary'] ?? false));

                                if (! $hasAnyPrimary) {
                                    $set('is_primary', true);
                                }
                            }),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Repeater::make('variants')
                    ->relationship()
                    ->label('Variants (Color / Size / Stock)')
                    ->defaultItems(0)
                    ->schema([
                        Select::make('color_id')
                            ->label('Color')
                            ->relationship('color', 'name_en')
                            ->searchable()
                            ->required(),
                        Select::make('size_id')
                            ->label('Size')
                            ->relationship('size', 'name_en')
                            ->searchable()
                            ->required(),
                        TextInput::make('stock')
                            ->label('Stock')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                        TextInput::make('sku')
                            ->label('SKU')
                            ->disabled()
                            ->dehydrated(false)
                            ->visibleOn('edit'),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ]);
    }
}

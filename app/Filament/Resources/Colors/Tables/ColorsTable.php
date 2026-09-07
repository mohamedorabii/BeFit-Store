<?php

namespace App\Filament\Resources\Colors\Tables;

use App\Models\Color;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ColorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ColorColumn::make('swatch')
                    ->label('Color')
                    ->getStateUsing(fn ($record) => $record->hex_code),

                TextColumn::make('name_en')
                    ->label('Name (English)')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name_ar')
                    ->label('Name (Arabic)')
                    ->searchable(),

                TextColumn::make('hex_code')
                    ->label('Hex Code')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state == 1 ? 'Active' : 'Not Active')
                    ->badge()
                    ->color(fn ($state) => $state == 1 ? 'success' : 'danger')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (DeleteAction $action, Color $record) {
                        if ($record->variants()->exists()) {
                            Notification::make()
                                ->danger()
                                ->title('Cannot delete this color')
                                ->body('This color is used by one or more product variants. Remove it from those variants first.')
                                ->send();

                            $action->halt();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (DeleteBulkAction $action, $records) {
                            $blocked = $records->filter(fn (Color $color) => $color->variants()->exists());

                            if ($blocked->isNotEmpty()) {
                                Notification::make()
                                    ->danger()
                                    ->title('Some colors could not be deleted')
                                    ->body('The following are used in product variants: ' . $blocked->pluck('name_en')->implode(', '))
                                    ->send();

                                $action->halt();
                            }
                        }),
                ]),
            ]);
    }
}
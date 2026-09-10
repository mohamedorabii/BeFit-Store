<?php

namespace App\Filament\Resources\ShippingOptions\Pages;

use App\Filament\Resources\ShippingOptions\ShippingOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditShippingOption extends EditRecord
{
    protected static string $resource = ShippingOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

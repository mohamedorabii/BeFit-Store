<?php

namespace App\Filament\Resources\ShippingOptions\Pages;

use App\Filament\Resources\ShippingOptions\ShippingOptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewShippingOption extends ViewRecord
{
    protected static string $resource = ShippingOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

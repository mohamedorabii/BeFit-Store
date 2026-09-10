<?php

namespace App\Filament\Resources\ShippingOptions\Pages;

use App\Filament\Resources\ShippingOptions\ShippingOptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShippingOption extends CreateRecord
{
    protected static string $resource = ShippingOptionResource::class;
}

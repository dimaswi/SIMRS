<?php

namespace App\Filament\Inventory\Resources\VendorBarangResource\Pages;

use App\Filament\Inventory\Resources\VendorBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVendorBarang extends CreateRecord
{
    protected static string $resource = VendorBarangResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

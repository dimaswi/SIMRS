<?php

namespace App\Filament\Inventory\Resources\VendorBarangResource\Pages;

use App\Filament\Inventory\Resources\VendorBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorBarang extends EditRecord
{
    protected static string $resource = VendorBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

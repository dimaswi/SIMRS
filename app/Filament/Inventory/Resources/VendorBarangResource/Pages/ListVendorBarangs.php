<?php

namespace App\Filament\Inventory\Resources\VendorBarangResource\Pages;

use App\Filament\Inventory\Resources\VendorBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorBarangs extends ListRecords
{
    protected static string $resource = VendorBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

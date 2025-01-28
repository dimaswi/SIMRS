<?php

namespace App\Filament\Inventory\Resources\SatuanBarangResource\Pages;

use App\Filament\Inventory\Resources\SatuanBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSatuanBarangs extends ListRecords
{
    protected static string $resource = SatuanBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

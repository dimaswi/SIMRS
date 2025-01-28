<?php

namespace App\Filament\Inventory\Resources\JenisBarangResource\Pages;

use App\Filament\Inventory\Resources\JenisBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisBarangs extends ListRecords
{
    protected static string $resource = JenisBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

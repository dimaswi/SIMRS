<?php

namespace App\Filament\Master\Resources\AgamaResource\Pages;

use App\Filament\Master\Resources\AgamaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgamas extends ListRecords
{
    protected static string $resource = AgamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

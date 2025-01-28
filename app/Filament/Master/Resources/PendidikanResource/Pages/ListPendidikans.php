<?php

namespace App\Filament\Master\Resources\PendidikanResource\Pages;

use App\Filament\Master\Resources\PendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendidikans extends ListRecords
{
    protected static string $resource = PendidikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

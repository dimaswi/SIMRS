<?php

namespace App\Filament\Master\Resources\PekerjaanResource\Pages;

use App\Filament\Master\Resources\PekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPekerjaans extends ListRecords
{
    protected static string $resource = PekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

<?php

namespace App\Filament\Master\Resources\JenisTarifResource\Pages;

use App\Filament\Master\Resources\JenisTarifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisTarifs extends ListRecords
{
    protected static string $resource = JenisTarifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

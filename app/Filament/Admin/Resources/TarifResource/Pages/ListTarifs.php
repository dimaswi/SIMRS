<?php

namespace App\Filament\Admin\Resources\TarifResource\Pages;

use App\Filament\Admin\Resources\TarifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTarifs extends ListRecords
{
    protected static string $resource = TarifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

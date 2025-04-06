<?php

namespace App\Filament\Master\Resources\ICD09Resource\Pages;

use App\Filament\Master\Resources\ICD09Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListICD09S extends ListRecords
{
    protected static string $resource = ICD09Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

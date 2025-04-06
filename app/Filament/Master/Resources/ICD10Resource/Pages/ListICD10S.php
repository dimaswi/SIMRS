<?php

namespace App\Filament\Master\Resources\ICD10Resource\Pages;

use App\Filament\Master\Resources\ICD10Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListICD10S extends ListRecords
{
    protected static string $resource = ICD10Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

<?php

namespace App\Filament\Master\Resources\JenisKelaminResource\Pages;

use App\Filament\Master\Resources\JenisKelaminResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisKelamins extends ListRecords
{
    protected static string $resource = JenisKelaminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

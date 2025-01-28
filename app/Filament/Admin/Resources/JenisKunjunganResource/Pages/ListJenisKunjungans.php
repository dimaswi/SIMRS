<?php

namespace App\Filament\Admin\Resources\JenisKunjunganResource\Pages;

use App\Filament\Admin\Resources\JenisKunjunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisKunjungans extends ListRecords
{
    protected static string $resource = JenisKunjunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

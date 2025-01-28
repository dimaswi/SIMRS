<?php

namespace App\Filament\Admin\Resources\PekerjaanUserResource\Pages;

use App\Filament\Admin\Resources\PekerjaanUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPekerjaanUsers extends ListRecords
{
    protected static string $resource = PekerjaanUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

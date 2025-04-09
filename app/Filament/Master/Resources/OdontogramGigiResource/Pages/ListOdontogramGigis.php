<?php

namespace App\Filament\Master\Resources\OdontogramGigiResource\Pages;

use App\Filament\Master\Resources\OdontogramGigiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOdontogramGigis extends ListRecords
{
    protected static string $resource = OdontogramGigiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

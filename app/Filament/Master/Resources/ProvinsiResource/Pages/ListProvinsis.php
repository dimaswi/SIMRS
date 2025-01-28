<?php

namespace App\Filament\Master\Resources\ProvinsiResource\Pages;

use App\Filament\Master\Resources\ProvinsiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProvinsis extends ListRecords
{
    protected static string $resource = ProvinsiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Inventory\Resources\SatuanBarangResource\Pages;

use App\Filament\Inventory\Resources\SatuanBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSatuanBarang extends EditRecord
{
    protected static string $resource = SatuanBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

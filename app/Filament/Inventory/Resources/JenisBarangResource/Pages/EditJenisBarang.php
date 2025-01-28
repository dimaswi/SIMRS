<?php

namespace App\Filament\Inventory\Resources\JenisBarangResource\Pages;

use App\Filament\Inventory\Resources\JenisBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisBarang extends EditRecord
{
    protected static string $resource = JenisBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

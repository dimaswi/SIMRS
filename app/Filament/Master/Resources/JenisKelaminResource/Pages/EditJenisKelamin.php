<?php

namespace App\Filament\Master\Resources\JenisKelaminResource\Pages;

use App\Filament\Master\Resources\JenisKelaminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisKelamin extends EditRecord
{
    protected static string $resource = JenisKelaminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

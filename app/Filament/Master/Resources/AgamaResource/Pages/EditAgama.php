<?php

namespace App\Filament\Master\Resources\AgamaResource\Pages;

use App\Filament\Master\Resources\AgamaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgama extends EditRecord
{
    protected static string $resource = AgamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

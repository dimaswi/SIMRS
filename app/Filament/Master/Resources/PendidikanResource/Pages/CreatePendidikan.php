<?php

namespace App\Filament\Master\Resources\PendidikanResource\Pages;

use App\Filament\Master\Resources\PendidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendidikan extends CreateRecord
{
    protected static string $resource = PendidikanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

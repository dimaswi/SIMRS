<?php

namespace App\Filament\Master\Resources\AgamaResource\Pages;

use App\Filament\Master\Resources\AgamaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAgama extends CreateRecord
{
    protected static string $resource = AgamaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

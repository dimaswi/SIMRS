<?php

namespace App\Filament\Master\Resources\PekerjaanResource\Pages;

use App\Filament\Master\Resources\PekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePekerjaan extends CreateRecord
{
    protected static string $resource = PekerjaanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

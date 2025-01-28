<?php

namespace App\Filament\Pendaftaran\Resources\PasienResource\Pages;

use App\Filament\Pendaftaran\Resources\PasienResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

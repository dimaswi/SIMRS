<?php

namespace App\Filament\Master\Resources\JenisKelaminResource\Pages;

use App\Filament\Master\Resources\JenisKelaminResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisKelamin extends CreateRecord
{
    protected static string $resource = JenisKelaminResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

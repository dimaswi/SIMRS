<?php

namespace App\Filament\Master\Resources\OdontogramGigiResource\Pages;

use App\Filament\Master\Resources\OdontogramGigiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOdontogramGigi extends CreateRecord
{
    protected static string $resource = OdontogramGigiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

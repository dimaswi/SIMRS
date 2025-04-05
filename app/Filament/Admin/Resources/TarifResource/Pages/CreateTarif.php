<?php

namespace App\Filament\Admin\Resources\TarifResource\Pages;

use App\Filament\Admin\Resources\TarifResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTarif extends CreateRecord
{
    protected static string $resource = TarifResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Master\Resources\JenisTarifResource\Pages;

use App\Filament\Master\Resources\JenisTarifResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisTarif extends CreateRecord
{
    protected static string $resource = JenisTarifResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

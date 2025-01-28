<?php

namespace App\Filament\Inventory\Resources\SatuanBarangResource\Pages;

use App\Filament\Inventory\Resources\SatuanBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSatuanBarang extends CreateRecord
{
    protected static string $resource = SatuanBarangResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

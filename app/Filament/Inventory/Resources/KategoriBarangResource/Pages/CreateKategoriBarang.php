<?php

namespace App\Filament\Inventory\Resources\KategoriBarangResource\Pages;

use App\Filament\Inventory\Resources\KategoriBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriBarang extends CreateRecord
{
    protected static string $resource = KategoriBarangResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

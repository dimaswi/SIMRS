<?php

namespace App\Filament\Inventory\Resources\JenisBarangResource\Pages;

use App\Filament\Inventory\Resources\JenisBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisBarang extends CreateRecord
{
    protected static string $resource = JenisBarangResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Admin\Resources\JenisKunjunganResource\Pages;

use App\Filament\Admin\Resources\JenisKunjunganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisKunjungan extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected static string $resource = JenisKunjunganResource::class;
}

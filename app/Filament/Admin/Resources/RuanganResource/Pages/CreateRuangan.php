<?php

namespace App\Filament\Admin\Resources\RuanganResource\Pages;

use App\Filament\Admin\Resources\RuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRuangan extends CreateRecord
{
    protected static string $resource = RuanganResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

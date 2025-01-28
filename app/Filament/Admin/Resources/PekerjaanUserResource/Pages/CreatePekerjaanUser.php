<?php

namespace App\Filament\Admin\Resources\PekerjaanUserResource\Pages;

use App\Filament\Admin\Resources\PekerjaanUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePekerjaanUser extends CreateRecord
{
    protected static string $resource = PekerjaanUserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

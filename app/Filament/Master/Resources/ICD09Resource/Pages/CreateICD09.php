<?php

namespace App\Filament\Master\Resources\ICD09Resource\Pages;

use App\Filament\Master\Resources\ICD09Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateICD09 extends CreateRecord
{
    protected static string $resource = ICD09Resource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

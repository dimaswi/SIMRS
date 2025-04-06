<?php

namespace App\Filament\Master\Resources\ICD10Resource\Pages;

use App\Filament\Master\Resources\ICD10Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateICD10 extends CreateRecord
{
    protected static string $resource = ICD10Resource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

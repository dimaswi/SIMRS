<?php

namespace App\Filament\Master\Resources\ICD10Resource\Pages;

use App\Filament\Master\Resources\ICD10Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditICD10 extends EditRecord
{
    protected static string $resource = ICD10Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

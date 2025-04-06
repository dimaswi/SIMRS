<?php

namespace App\Filament\Master\Resources\ICD09Resource\Pages;

use App\Filament\Master\Resources\ICD09Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditICD09 extends EditRecord
{
    protected static string $resource = ICD09Resource::class;

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

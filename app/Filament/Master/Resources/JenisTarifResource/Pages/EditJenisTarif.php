<?php

namespace App\Filament\Master\Resources\JenisTarifResource\Pages;

use App\Filament\Master\Resources\JenisTarifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisTarif extends EditRecord
{
    protected static string $resource = JenisTarifResource::class;

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

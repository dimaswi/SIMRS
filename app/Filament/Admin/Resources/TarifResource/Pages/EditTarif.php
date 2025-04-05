<?php

namespace App\Filament\Admin\Resources\TarifResource\Pages;

use App\Filament\Admin\Resources\TarifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTarif extends EditRecord
{
    protected static string $resource = TarifResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

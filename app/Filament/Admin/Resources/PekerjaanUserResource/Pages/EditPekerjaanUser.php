<?php

namespace App\Filament\Admin\Resources\PekerjaanUserResource\Pages;

use App\Filament\Admin\Resources\PekerjaanUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPekerjaanUser extends EditRecord
{
    protected static string $resource = PekerjaanUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

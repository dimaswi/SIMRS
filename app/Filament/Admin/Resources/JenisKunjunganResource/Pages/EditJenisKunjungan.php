<?php

namespace App\Filament\Admin\Resources\JenisKunjunganResource\Pages;

use App\Filament\Admin\Resources\JenisKunjunganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisKunjungan extends EditRecord
{
    protected static string $resource = JenisKunjunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\TindakanResource\Pages;

use App\Filament\Admin\Resources\TindakanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTindakan extends EditRecord
{
    protected static string $resource = TindakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

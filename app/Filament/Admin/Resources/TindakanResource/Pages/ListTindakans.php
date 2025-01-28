<?php

namespace App\Filament\Admin\Resources\TindakanResource\Pages;

use App\Filament\Admin\Resources\TindakanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTindakans extends ListRecords
{
    protected static string $resource = TindakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

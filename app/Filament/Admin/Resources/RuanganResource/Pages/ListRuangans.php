<?php

namespace App\Filament\Admin\Resources\RuanganResource\Pages;

use App\Filament\Admin\Resources\RuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRuangans extends ListRecords
{
    protected static string $resource = RuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah')->icon('heroicon-o-plus-circle')->color('success'),
        ];
    }
}

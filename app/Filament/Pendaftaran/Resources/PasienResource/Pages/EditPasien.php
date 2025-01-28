<?php

namespace App\Filament\Pendaftaran\Resources\PasienResource\Pages;

use App\Filament\Pendaftaran\Resources\PasienResource;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPasien extends EditRecord
{
    protected static string $resource = PasienResource::class;

    use HasPageSidebar;

}

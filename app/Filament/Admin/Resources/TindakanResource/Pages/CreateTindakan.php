<?php

namespace App\Filament\Admin\Resources\TindakanResource\Pages;

use App\Filament\Admin\Resources\TindakanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTindakan extends CreateRecord
{
    protected static string $resource = TindakanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['total_tagihan'] = $data['tagihan_dokter'] + $data['tagihan_perawat'] + $data['tagihan_farmasi'] + $data['tagihan_sarana'] + $data['tagihan_oksigen'];

        return $data;
    }
}

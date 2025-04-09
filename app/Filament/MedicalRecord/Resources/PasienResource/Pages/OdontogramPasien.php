<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Resources\Pages\Page;

class OdontogramPasien extends Page
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.odontogram-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    public $nama_gigi;

    public function odontogram($gigi, $lokasi)
    {
        if ($lokasi === 'A') {
            $nama_lokasi = 'Atas';
        }else if ($lokasi === 'B') {
            $nama_lokasi = 'Bawah';
        }else if ($lokasi === 'C') {
            $nama_lokasi = 'Kanan';
        }else if ($lokasi === 'D') {
            $nama_lokasi = 'Kiri';
        }else if ($lokasi === 'E') {
            $nama_lokasi = 'Tengah';
        }

        $this->nama_gigi = $gigi. ' Bagian ' .$nama_lokasi;
        $this->dispatch('open-modal', id:'modal-odontogram');
    }
}

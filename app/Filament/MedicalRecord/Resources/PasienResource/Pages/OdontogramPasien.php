<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\Master\OdontogramGigi;
use App\Models\MedicalRecord\Odontogram;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class OdontogramPasien extends Page
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.odontogram-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    public $teeth = [];
    public $nomorGigi;
    public $posisiGigi;
    public $transformGigi;
    public $selectedTooth;
    public $master_kondisi;
    public $kondisi = 1;
    public $tindakan;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reset')
                ->label('Hapus Semua')
                ->icon('heroicon-o-arrow-path')
                ->action('resetOdontogram')
                ->color('danger')
                ->requiresConfirmation()
                ->action(
                    function () {
                        Odontogram::where('kunjungan_id', $this->record->id)->delete();
                        Notification::make()
                            ->title('Berhasil')
                            ->body('Data berhasil dihapus!')
                            ->success()
                            ->send();

                        // Redirect ke halaman yang sama
                        return redirect()->to(url()->previous());
                    }
                ),
        ];
    }

    public function mount()
    {
        $data_odontogram = Odontogram::where('kunjungan_id', $this->record->id)->with('kondisi_gigi')->get();

        // Data baru dari $data_odontogram
        $newTeethData = [];
        foreach ($data_odontogram as $value) {
            $newTeethData[] = [
                'kondisi' => $value->kondisi_gigi->simbol,
                'number' => $value->nomor_gigi,
                'transform' => $value->transform,
                'posisi' => $value->posisi,
            ];
        }

        // Data awal $this->teeth
        $this->teeth = [
            // Baris pertama (rahang atas kiri)
            ['kondisi' => null, 'posisi' => null, 'number' => '18', 'transform' => 'translate(0,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '17', 'transform' => 'translate(25,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '16', 'transform' => 'translate(50,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '15', 'transform' => 'translate(75,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '14', 'transform' => 'translate(100,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '13', 'transform' => 'translate(125,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '12', 'transform' => 'translate(150,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '11', 'transform' => 'translate(175,20)'],

            // Baris kedua (rahang atas kanan)
            ['kondisi' => null, 'posisi' => null, 'number' => '21', 'transform' => 'translate(210,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '22', 'transform' => 'translate(235,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '23', 'transform' => 'translate(260,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '24', 'transform' => 'translate(285,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '25', 'transform' => 'translate(310,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '26', 'transform' => 'translate(335,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '27', 'transform' => 'translate(360,20)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '28', 'transform' => 'translate(385,20)'],

            // Baris ketiga (gigi susu atas kiri)
            ['kondisi' => null, 'posisi' => null, 'number' => '55', 'transform' => 'translate(75,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '54', 'transform' => 'translate(100,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '53', 'transform' => 'translate(125,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '52', 'transform' => 'translate(150,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '51', 'transform' => 'translate(175,70)'],

            // Baris keempat (gigi susu atas kanan)
            ['kondisi' => null, 'posisi' => null, 'number' => '61', 'transform' => 'translate(210,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '62', 'transform' => 'translate(235,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '63', 'transform' => 'translate(260,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '64', 'transform' => 'translate(285,70)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '65', 'transform' => 'translate(310,70)'],

            // Baris kelima (gigi susu bawah kiri)
            ['kondisi' => null, 'posisi' => null, 'number' => '85', 'transform' => 'translate(75,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '84', 'transform' => 'translate(100,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '83', 'transform' => 'translate(125,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '82', 'transform' => 'translate(150,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '81', 'transform' => 'translate(175,120)'],

            // Baris keenam (gigi susu bawah kanan)
            ['kondisi' => null, 'posisi' => null, 'number' => '71', 'transform' => 'translate(210,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '72', 'transform' => 'translate(235,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '73', 'transform' => 'translate(260,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '74', 'transform' => 'translate(285,120)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '75', 'transform' => 'translate(310,120)'],

            // Baris ketujuh (rahang bawah kiri)
            ['kondisi' => null, 'posisi' => null, 'number' => '48', 'transform' => 'translate(0,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '47', 'transform' => 'translate(25,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '46', 'transform' => 'translate(50,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '45', 'transform' => 'translate(75,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '44', 'transform' => 'translate(100,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '43', 'transform' => 'translate(125,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '42', 'transform' => 'translate(150,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '41', 'transform' => 'translate(175,170)'],

            // Baris kedelapan (rahang bawah kanan)
            ['kondisi' => null, 'posisi' => null, 'number' => '31', 'transform' => 'translate(210,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '32', 'transform' => 'translate(235,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '33', 'transform' => 'translate(260,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '34', 'transform' => 'translate(285,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '35', 'transform' => 'translate(310,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '36', 'transform' => 'translate(335,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '37', 'transform' => 'translate(360,170)'],
            ['kondisi' => null, 'posisi' => null, 'number' => '38', 'transform' => 'translate(385,170)'],
        ];

        // Replace data lama dengan data baru berdasarkan key 'number'
        foreach ($this->teeth as &$tooth) {
            foreach ($newTeethData as $newTooth) {
                if ($tooth['number'] === $newTooth['number']) {
                    // Jika key 'posisi' belum berupa array, ubah menjadi array kosong
                    if (!is_array($tooth['posisi'])) {
                        $tooth['posisi'] = [];
                    }

                    // Tambahkan posisi baru ke array 'posisi' dengan key sesuai nama value
                    if (!empty($newTooth['posisi']) && is_array($tooth['posisi']) && !array_key_exists($newTooth['posisi'], $tooth['posisi'])) {
                        $tooth['posisi'][$newTooth['posisi']] = $newTooth['posisi'];
                    }

                    // Jika key 'kondisi' belum berupa array, ubah menjadi array kosong
                    if (!is_array($tooth['kondisi'])) {
                        $tooth['kondisi'] = [
                            'Atas' => null,
                            'Bawah' => null,
                            'Kanan' => null,
                            'Kiri' => null,
                            'Tengah' => null,
                        ];
                    }

                    // Tambahkan kondisi baru ke array 'kondisi' dengan key sesuai nama posisi
                    if (!empty($newTooth['posisi']) && is_array($tooth['kondisi']) && array_key_exists($newTooth['posisi'], $tooth['kondisi'])) {
                        $tooth['kondisi'][$newTooth['posisi']] = $newTooth['kondisi'];
                    }

                    // Tetap pertahankan data lainnya tanpa menggabungkan
                    $tooth['transform'] = $newTooth['transform'] ?? $tooth['transform'];
                }
            }

            // Pastikan semua key tetap ada dengan nilai null jika belum diisi untuk 'posisi'
            $tooth['posisi'] = array_merge(
                [
                    'Atas' => null,
                    'Bawah' => null,
                    'Kanan' => null,
                    'Kiri' => null,
                    'Tengah' => null,
                ],
                is_array($tooth['posisi']) ? $tooth['posisi'] : []
            );

            // Pastikan semua key tetap ada dengan nilai null jika belum diisi untuk 'kondisi'
            $tooth['kondisi'] = array_merge(
                [
                    'Atas' => null,
                    'Bawah' => null,
                    'Kanan' => null,
                    'Kiri' => null,
                    'Tengah' => null,
                ],
                is_array($tooth['kondisi']) ? $tooth['kondisi'] : []
            );
        }

        // Debugging untuk memastikan hasil
        // dd($this->teeth);
    }

    public function odontogram($toothNumber, $section, $transform)
    {
        $data_gigi = Odontogram::where('kunjungan_id', $this->record->id)
            ->where('nomor_gigi', $toothNumber)
            ->where('posisi', $section)
            ->first();

        $this->selectedTooth = $toothNumber . ' ' . $section;
        $this->nomorGigi = $toothNumber;
        $this->posisiGigi = $section;
        $this->transformGigi = $transform;
        $this->master_kondisi = OdontogramGigi::all();
        $this->kondisi = $data_gigi ? $data_gigi->kondisi : 1;
        $this->tindakan = $data_gigi ? $data_gigi->tindakan : null;
        $this->dispatch('open-modal', id: 'odontogram-modal');
    }

    public function simpan()
    {
        try {
            // Ambil data gigi berdasarkan nomor gigi dan posisi
            $data_gigi = Odontogram::where('kunjungan_id', $this->record->id)
                ->where('nomor_gigi', $this->nomorGigi)
                ->get();

            // Periksa apakah ada value 'non' pada data gigi
            if ($data_gigi->contains('kondisi', '2')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "non" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'non' ditemukan
            }

            if ($data_gigi->contains('kondisi', '3')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "une" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'une' ditemukan
            }

            if ($data_gigi->contains('kondisi', '4')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "pre" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'pre' ditemukan
            }

            if ($data_gigi->contains('kondisi', '5')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "imx" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'imx' ditemukan
            }

            if ($data_gigi->contains('kondisi', '6')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "ano" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'ano' ditemukan
            }

            if ($data_gigi->contains('kondisi', '9')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "rrx" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'rrx' ditemukan
            }

            if ($data_gigi->contains('kondisi', '10')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "mis" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'mis' ditemukan
            }

            if ($data_gigi->contains('kondisi', '11')) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Nomor gigi ini memiliki kondisi "mpm" dan tidak dapat ditambahkan data lain.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika kondisi 'mpm' ditemukan
            }

            // Periksa Data Gigi dengan Posisi Jika Sudah Ada Isinya Maka Tidak Dapat Melakukan Create Data
            $data_gigi_terisi_dengan_posisi = Odontogram::where('kunjungan_id', $this->record->id)
                ->where('nomor_gigi', $this->nomorGigi)
                ->where('posisi', $this->posisiGigi)
                ->first();

            // Periksa apakah data gigi sudah ada
            if ($data_gigi_terisi_dengan_posisi) {
                Notification::make()
                    ->title('Gagal')
                    ->body('Data gigi pada nomor dan posisi ini sudah diisi.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika data sudah ada
            }

            // Check Jika Data Gigi Sudah Ada Maka Tidak Dapat Melakukan Pembuatan Data Yang Meliputi Satu Gigi Tidak Posisi
            $data_gigi_terisi_dengan_posisi = Odontogram::where('kunjungan_id', $this->record->id)
                ->where('nomor_gigi', $this->nomorGigi)
                ->get();

            if (($this->kondisi == 2 && $data_gigi_terisi_dengan_posisi->isNotEmpty()) || ($this->kondisi == 3 && $data_gigi_terisi_dengan_posisi->isNotEmpty()) || ($this->kondisi == 4 && $data_gigi_terisi_dengan_posisi->isNotEmpty()) || ($this->kondisi == 5 && $data_gigi_terisi_dengan_posisi->isNotEmpty()) || ($this->kondisi == 6 && $data_gigi_terisi_dengan_posisi->isNotEmpty()) || ($this->kondisi == 9 && $data_gigi_terisi_dengan_posisi->isNotEmpty()) || ($this->kondisi == 10 && $data_gigi_terisi_dengan_posisi->isNotEmpty()) || ($this->kondisi == 11 && $data_gigi_terisi_dengan_posisi->isNotEmpty())) {
                // Jika kondisi adalah 2, 3, 4, 5, 6, 9, 10, atau 11
                Notification::make()
                    ->title('Gagal')
                    ->body('Silahkan hapus semua data pada gigi.')
                    ->danger()
                    ->send();
                $this->dispatch('close-modal', id: 'odontogram-modal');
                return; // Hentikan proses jika data sudah ada
            }

            Odontogram::create([
                'kunjungan_id' => $this->record->id,
                'pendaftaran_id' => $this->record->pendaftaran_id,
                'nomor_gigi' => $this->nomorGigi,
                'posisi' => $this->posisiGigi,
                'transform' => $this->transformGigi,
                'kondisi' => $this->kondisi,
                'tindakan' => $this->tindakan,
                'tanggal' => now('Asia/Jakarta'),
            ]);
            $this->dispatch('close-modal', id: 'odontogram-modal');

            Notification::make()
                ->title('Berhasil')
                ->body('Data berhasil disimpan')
                ->success()
                ->send();

            // Redirect ke halaman yang sama
            return redirect()->to(url()->previous());
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Gagal')
                ->body($th->getMessage())
                ->danger()
                ->send();
        }
        $this->dispatch('close-modal', id: 'odontogram-modal');
    }

    public function hapus()
    {
        try {
            Odontogram::where('kunjungan_id', $this->record->id)
                ->where('nomor_gigi', $this->nomorGigi)
                ->where('posisi', $this->posisiGigi)
                ->delete();

            Notification::make()
                ->title('Berhasil')
                ->body('Data berhasil dihapus')
                ->success()
                ->send();

            // Redirect ke halaman yang sama
            return redirect()->to(url()->previous());
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Gagal')
                ->body($th->getMessage())
                ->danger()
                ->send();
        }
    }

    public function hapus_data_gigi()
    {
        try {
            Odontogram::where('kunjungan_id', $this->record->id)
                ->where('nomor_gigi', $this->nomorGigi)
                ->delete();

            Notification::make()
                ->title('Berhasil')
                ->body('Data berhasil dihapus')
                ->success()
                ->send();

            // Redirect ke halaman yang sama
            return redirect()->to(url()->previous());
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Gagal')
                ->body($th->getMessage())
                ->danger()
                ->send();
        }
    }
}

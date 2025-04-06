<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;

class PemeriksaanPasien extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.pemeriksaan-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('TTV')
                            ->schema([
                                TextInput::make('keadaan_umum')
                                    ->placeholder('Masukan keadaan umum pasien saat masuk ruangan')
                                    ->columnSpanFull(),
                                Select::make('tingkat_kesadaran')
                                    ->options([
                                        'Sadar Baik' => 'Sadar Baik',
                                        'Berespons Dengan Kata-Kata' => 'Berespons Dengan Kata-Kata',
                                        'Hanya Berespons Jika Dirangsan Nyeri' => 'Hanya Berespons Jika Dirangsan Nyeri',
                                        'Pasien Tidak Sadar' => 'Pasien Tidak Sadar',
                                        'Gelisah atau Bingung' => 'Gelisah atau Bingung',
                                        'Acute Confusional State' => 'Acute Confusional State',
                                    ])
                                    ->columnSpanFull()
                                    ->searchable(),
                                TextInput::make('eye')
                                    ->label('E (eye)')
                                    ->numeric()
                                    ->live()
                                    ->afterStateUpdated(
                                        function (Get $get, Set $set) {
                                            $nilai_gcs = $get('eye') + $get('motorik') + $get('verbal');

                                            $set('GCS', $nilai_gcs);
                                        }
                                    )
                                    ->default(0),
                                TextInput::make('motorik')
                                    ->label('M (motorik)')
                                    ->numeric()
                                    ->live()
                                    ->afterStateUpdated(
                                        function (Get $get, Set $set) {
                                            $nilai_gcs = $get('eye') + $get('motorik') + $get('verbal');

                                            $set('GCS', $nilai_gcs);
                                        }
                                    )
                                    ->default(0),
                                TextInput::make('verbal')
                                    ->label('V (verbal)')
                                    ->numeric()
                                    ->live()
                                    ->afterStateUpdated(
                                        function (Get $get, Set $set) {
                                            $nilai_gcs = $get('eye') + $get('motorik') + $get('verbal');

                                            $set('GCS', $nilai_gcs);
                                        }
                                    )
                                    ->default(0),
                                TextInput::make('GCS')
                                    ->label('GCS')
                                    ->live()
                                    ->readOnly()
                                    ->default(0),
                                TextInput::make('tekanan_darah_sistolik')
                                    ->label('Sistolik /mmHg')
                                    ->default(0)
                                    ->numeric()
                                    ->columnSpan(2),
                                TextInput::make('tekanan_darah_distolik')
                                    ->label('Distolik /mmHg')
                                    ->default(0)
                                    ->numeric()
                                    ->columnSpan(2),
                                TextInput::make('frekuensi_nafas')
                                    ->label('Nafas /menit')
                                    ->default(0),
                                TextInput::make('frekuensi_nadi')
                                    ->label('Nadi /menit')
                                    ->default(0),
                                TextInput::make('suhu')
                                    ->label('Suhu Tubuh (Celcius)')
                                    ->default(0),
                                TextInput::make('saturasi_oksigen')
                                    ->label('Saturasi Oksigen')
                                    ->default(0),
                            ])->columns(4),
                        Tab::make('Antropometri')
                            ->schema([
                                TextInput::make('berat_badan')
                                    ->label('Berat Badan (Kg)')
                                    ->numeric()
                                    ->columnSpan(2)
                                    // ->live()
                                    // ->afterStateUpdated(
                                    //     function (Get $get, Set $set) {

                                    //         if ($get('tinggi_badan') == 0) {
                                    //             $set('imt', 0);
                                    //         } else {
                                    //             $imt = $get('berat_badan') / ($get('tinggi_badan') / 100);
                                    //             $set('imt', $imt);
                                    //         }
                                    //     }
                                    // )
                                    ->default(0),
                                TextInput::make('tinggi_badan')
                                    ->label('Tinggi Badan (cm)')
                                    ->numeric()
                                    ->columnSpan(3)
                                    // ->live()
                                    // ->afterStateUpdated(
                                    //     function (Get $get, Set $set) {
                                    //         $imt = $get('berat_badan') / ($get('tinggi_badan') / 100);

                                    //         $set('imt', $imt);
                                    //     }
                                    // )
                                    ->default(0),
                                // TextInput::make('imt')
                                //     ->label('Indek Massa Tubuh')
                                //     ->numeric()
                                //     ->live()
                                //     ->readOnly()
                                //     ->default(0),
                                Fieldset::make('Lingkar')
                                    ->schema([
                                        TextInput::make('lingkar_lengan_atas')
                                            ->label('Lengan Atas (cm)')
                                            ->numeric()
                                            ->default(0),
                                        TextInput::make('lingkar_kepala')
                                            ->label('Kepala (cm)')
                                            ->numeric()
                                            ->default(0),
                                        TextInput::make('lingkar_perut')
                                            ->label('Perut (cm)')
                                            ->numeric()
                                            ->default(0),
                                    ])->columns(3)
                                    ->columnSpan(3),

                                Fieldset::make('Panjang')
                                    ->schema([
                                        TextInput::make('tinggi_lutut')
                                            ->label('Lutut (cm)')
                                            ->numeric()
                                            ->default(0),
                                        TextInput::make('panjang_ulna')
                                            ->label('Ulna (cm)')
                                            ->numeric()
                                            ->default(0),
                                    ])->columns(2)
                                    ->columnSpan(2),
                                Select::make('kondisi_anak')
                                    ->searchable()
                                    ->options([
                                        'Prematur' => 'Prematur',
                                        'Down Syndrome' => 'Down Syndrome',
                                        'Normal' => 'Normal',
                                    ])
                                    ->default('Normal')
                                    ->columnSpanFull(),
                                TextInput::make('pemeriksaan_ke')
                                    ->label('Pemeriksaan Ke -')
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpanFull(),
                            ])->columns(5),
                    ])
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }
}

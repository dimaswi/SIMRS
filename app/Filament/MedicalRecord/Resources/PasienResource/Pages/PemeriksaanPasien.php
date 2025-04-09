<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\Aplikasi\TarifToRuangan;
use App\Models\MedicalRecord\PemeriksaanUmum;
use App\Models\Pembayaran\Tagihan;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Carbon\Carbon;
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
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class PemeriksaanPasien extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.pemeriksaan-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    // public ?array $data = [];

    // public function mount(): void
    // {
    //     $this->form->fill();
    // }

    public function table(Table $table): Table
    {
        return $table
            ->query(PemeriksaanUmum::query()->where('kunjungan_id', $this->record->id))
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('tanggal_pemeriksaan')
                    ->badge(),
                TextColumn::make('user.nama')
                    ->searchable(),
            ])
            ->emptyStateHeading('Tidak Ada Pemeriksaan Ditambahkan')
            // ->emptyStateDescription('Pastikan Menambahkan ICD 10 pada Master!')
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('lihat')
                    ->label('Detail')
                    ->color('info')
                    ->icon('heroicon-m-eye')
                    ->modalContent(fn (PemeriksaanUmum $record): View => view(
                        'filament.medical-record.resources.pasien-resource.pages.modal-pemeriksaan-umum-pasien',
                        ['record' => $record],
                    ))
                    ->modalSubmitAction(false),
                DeleteAction::make()
                ->before(function (PemeriksaanUmum $record) {
                    try {
                        $tarif_ruangan = TarifToRuangan::where('ruangan_id', $this->record->ruangan_id)->where('jenis_tarif_id', 2)->with(['tarif', 'ruangan'])->first();
                        $tagihan = Tagihan::where('tarif_id', $tarif_ruangan->id)->where('created_at', $record->created_at)->first();
                        dd($tagihan);
                        $tagihan->delete();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        Notification::make()
                            ->title('Gagal!')
                            ->body($th->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            ])
            ->bulkActions([
                // ...
            ])
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
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
                                            ->required()
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
                                            ->default(
                                                function ()
                                                {
                                                    $pemeriksaan_sebelumnya = PemeriksaanUmum::where('kunjungan_id', $this->record->id)->latest('tanggal_pemeriksaan')->first();
                                                    return $pemeriksaan_sebelumnya != null ? (int)$pemeriksaan_sebelumnya->berat_badan : 0;
                                                }
                                            ),
                                        TextInput::make('tinggi_badan')
                                            ->label('Tinggi Badan (cm)')
                                            ->numeric()
                                            ->required()
                                            ->columnSpan(3)
                                            // ->live()
                                            // ->afterStateUpdated(
                                            //     function (Get $get, Set $set) {
                                            //         $imt = $get('berat_badan') / ($get('tinggi_badan') / 100);

                                            //         $set('imt', $imt);
                                            //     }
                                            // )
                                            ->default(
                                                function ()
                                                {
                                                    $pemeriksaan_sebelumnya = PemeriksaanUmum::where('kunjungan_id', $this->record->id)->latest('tanggal_pemeriksaan')->first();
                                                    return $pemeriksaan_sebelumnya != null ? (int)$pemeriksaan_sebelumnya->tinggi_badan : 0;
                                                }
                                            ),
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
                    ->action(
                        function (array $data) {
                            try {
                                $tarif_ruangan = TarifToRuangan::where('ruangan_id', $this->record->ruangan_id)->where('jenis_tarif_id', 2)->with(['tarif', 'ruangan'])->first();
                                DB::beginTransaction();

                                PemeriksaanUmum::create([
                                    'kunjungan_id' => $this->record->id,
                                    'keadaan_umum' => $data['keadaan_umum'],
                                    'tingkat_kesadaran' => $data['tingkat_kesadaran'],
                                    'eye' => $data['eye'],
                                    'motorik' => $data['motorik'],
                                    'verbal' => $data['verbal'],
                                    'GCS' => $data['GCS'],
                                    'tekanan_darah_sistolik' => $data['tekanan_darah_sistolik'],
                                    'tekanan_darah_distolik' => $data['tekanan_darah_distolik'],
                                    'frekuensi_nafas' => $data['frekuensi_nafas'],
                                    'frekuensi_nadi' => $data['frekuensi_nadi'],
                                    'suhu' => $data['suhu'],
                                    'saturasi_oksigen' => $data['saturasi_oksigen'],
                                    'berat_badan' => $data['berat_badan'],
                                    'tinggi_badan' => $data['tinggi_badan'],
                                    'lingkar_lengan_atas' => $data['lingkar_lengan_atas'],
                                    'lingkar_kepala' => $data['lingkar_kepala'],
                                    'tinggi_lutut' => $data['tinggi_lutut'],
                                    'panjang_ulna' => $data['panjang_ulna'],
                                    'lingkar_perut' => $data['lingkar_perut'],
                                    'kondisi_anak' => $data['kondisi_anak'],
                                    'pemeriksaan_ke' => $data['pemeriksaan_ke'],
                                    // 'alat_bantu_nafas' => $data['alat_bantu_nafas'],
                                    'tanggal_pemeriksaan' => Carbon::now('Asia/Jakarta'),
                                    'petugas' => auth()->user()->id
                                ]);

                                Tagihan::create([
                                    'pendaftaran_id' => $this->record->pendaftaran_id,
                                    'kunjungan_id' => $this->record->id,
                                    'tarif_id' => $tarif_ruangan->id,
                                    'nominal' => $tarif_ruangan->tarif->tarif,
                                    'jumlah' => 1
                                ]);

                                DB::commit();
                                Notification::make()
                                    ->title('Berhasil!')
                                    ->body('Data Pemeriksaan Berhasil Disimpan!')
                                    ->success()
                                    ->send();
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                Notification::make()
                                    ->title('Gagal!')
                                    ->body($th->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        }
                    )
            ]);
    }
}

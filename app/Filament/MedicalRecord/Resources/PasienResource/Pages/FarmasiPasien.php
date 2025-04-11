<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\Aplikasi\BarangToRuangan;
use App\Models\Inventory\Barang;
use App\Models\MedicalRecord\Diagnosa;
use App\Models\MedicalRecord\OrderResep;
use App\Models\MedicalRecord\OrderResepDetil;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class FarmasiPasien extends Page implements HasForms, HasTable
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.farmasi-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    use InteractsWithForms;

    use InteractsWithTable;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('riwayatOrder')
                ->label('Riwayat Order')
                ->color('warning')
                ->icon('heroicon-o-clock')
                ->url(
                    PasienResource::getUrl('riwayatOrderResep', ['record' => $this->record->id])
                ),
            Action::make('orderResep')
                ->label('Kirim Resep')
                ->color('success')
                ->icon('bi-receipt')
                ->form([
                    TextInput::make('alergi_obat')
                        ->label('Alergi Obat')
                        ->placeholder('Masukan Alergi Obat'),
                    TextInput::make('gangguan_fungsi_ginjal')
                        ->label('Gangguan Fungsi Ginjal')
                        ->placeholder('Masukan Gangguan Fungsi Ginjal'),
                ])
                ->action(
                    function (array $data)
                    {
                        try {
                            $primary_diagnosa = Diagnosa::where('kunjungan_id', $this->record->id)->where('kategori', 'Primary')->with('diagnosa')->first();
                            DB::beginTransaction();

                            $data_order = OrderResep::create([
                                'kunjungan_id' => $this->record->id,
                                'pemberi_resep' => auth()->user()->id,
                                'dokter_dpjp' => $this->record->dokter_id,
                                'diagnosa' => $primary_diagnosa->diagnosa->code,
                                'alergi_obat' => $data['alergi_obat'],
                                'gangguan_fungsi_ginjal' => $data['gangguan_fungsi_ginjal'],
                            ]);

                            OrderResepDetil::where('kunjungan_id', $this->record->id)->where('order_resep_id', null)->update([
                                'order_resep_id' => $data_order->id,
                            ]);

                            DB::commit();

                            Notification::make()
                                ->title('Berhasil')
                                ->body('Berhasil mengirim resep')
                                ->success()
                                ->send();
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            Notification::make()
                                ->title('Gagal')
                                ->body($th->getMessage())
                                ->danger()
                                ->send();
                        }
                    }
                ),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('obat_id')
                        ->label('Nama Obat')
                        ->options(
                            BarangToRuangan::where('id_ruangan', $this->record->ruangan_id)->with('barang') // Relasi ke model Barang
                                ->get()
                                ->mapWithKeys(function ($barang) {
                                    return [$barang->id => $barang->barang->nama_barang];
                                })
                                ->toArray()
                        )
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpan(3),
                    TextInput::make('aturan_pakai')
                        ->label('Aturan Pakai')
                        ->required()
                        ->columnSpan(2),
                    TextInput::make('dosis')
                        ->label('Dosis')
                        ->required()
                        ->columnSpan(2),
                    TextInput::make('frekuensi')
                        ->label('Frekuensi')
                        ->required()
                        ->columnSpan(2),
                    TextInput::make('rute_pemberian')
                        ->label('Rute')
                        ->required()
                        ->columnSpan(2),
                    TextInput::make('jumlah')
                        ->label('Jumlah')
                        ->numeric()
                        ->required()
                        ->minValue(1)
                        ->maxValue(100)
                        ->default(1)
                        ->columnSpan(1),
                ])->columns(12)
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $data_obat = BarangToRuangan::where('id', $data['obat_id'])->with('barang')->first();

        try {
            OrderResepDetil::create([
                'kunjungan_id' => $this->record->id,
                'obat_id' => $data['obat_id'],
                'aturan_pakai' => $data['aturan_pakai'],
                'dosis' => $data['dosis'],
                'frekuensi' => $data['frekuensi'],
                'rute_pemberian' => $data['rute_pemberian'],
                'jumlah' => $data['jumlah'],
                'harga' => $data_obat->barang->harga_jual,
            ]);

            $this->form->fill();

            Notification::make()
                ->title('Berhasil')
                ->body('Berhasil menambahkan data resep')
                ->success()
                ->send();
        } catch (\Throwable $th) {
            Notification::make()
                ->title('Gagal')
                ->body($th->getMessage())
                ->danger()
                ->send();
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderResepDetil::query()->where('kunjungan_id', $this->record->id)->where('order_resep_id', null)
                )
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('obat.barang.nama_barang')
                    ->label('Nama Obat'),
                TextColumn::make('aturan_pakai')
                    ->label('Aturan Pakai'),
                TextColumn::make('dosis')
                    ->label('Dosis'),
                TextColumn::make('frekuensi')
                    ->label('Frekuensi'),
                TextColumn::make('rute_pemberian')
                    ->label('Rute Pemberian'),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->badge(),
            ])
            ->actions([
                DeleteAction::make()
            ])
            ->bulkActions([
                // ...
            ]);
    }
}

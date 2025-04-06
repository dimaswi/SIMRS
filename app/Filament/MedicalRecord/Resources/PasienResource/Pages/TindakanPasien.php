<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\Aplikasi\TindakanToRuangan;
use App\Models\Master\ICD10;
use App\Models\MedicalRecord\Diagnosa;
use App\Models\MedicalRecord\Tindakan;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class TindakanPasien extends Page implements HasForms, HasTable
{
    use InteractsWithForms;

    use InteractsWithTable;

    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.tindakan-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(Tindakan::query()->where('kunjungan_id', $this->record->id))
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('tindakan.tindakan.nama_tindakan')
                    ->label('Nama Tindakan')
                    ->searchable(),
                TextColumn::make('user.nama')
                    ->label('Nama Petugas'),
            ])
            ->emptyStateHeading('Tidak Ada Tindakan Ditambahkan')
            ->emptyStateDescription('Pastikan Menambahkan Tindakan pada Master!')
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make()
            ])
            ->bulkActions([
                // ...
            ])
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        Select::make('tindakan')
                            ->label('Tindakan')
                            ->searchDebounce(1000)
                            ->options(
                                function () {
                                    $tindakan = TindakanToRuangan::where('id_tindakan', '!=', null)
                                        ->get()
                                        ->mapWithKeys(function ($tindakan) {
                                            return [$tindakan->id => $tindakan->tindakan->nama_tindakan];
                                        })->toArray();
                                    return $tindakan;
                                }
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->action(
                        function (array $data) {
                            try {
                                DB::beginTransaction();
                                    Tindakan::create([
                                        'kunjungan_id' => $this->record->id,
                                        'tindakan_id' => $data['tindakan'],
                                        'petugas' => auth()->user()->id,
                                        'tanggal_tindakan' => Carbon::now('Asia/Jakarta'),
                                    ]);
                                DB::commit();

                                Notification::make()
                                    ->title('Berhasil!')
                                    ->body('Data Tindakan Berhasil Disimpan!')
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

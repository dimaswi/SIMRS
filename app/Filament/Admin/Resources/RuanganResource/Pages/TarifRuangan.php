<?php

namespace App\Filament\Admin\Resources\RuanganResource\Pages;

use App\Filament\Admin\Resources\RuanganResource;
use App\Models\Aplikasi\TarifToRuangan;
use Filament\Resources\Pages\Page;
use App\Models\Master\Ruangan;
use App\Models\Master\Tarif;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;

class TarifRuangan extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = RuanganResource::class;

    protected static string $view = 'filament.admin.resources.ruangan-resource.pages.tarif-ruangan';

    use HasPageSidebar;

    public Ruangan $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                TarifToRuangan::where('ruangan_id', $this->record->id)
            )
            ->columns([
                TextColumn::make('index')
                    ->alignCenter()
                    ->rowIndex()
                    ->label('No.')
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('tarif.nama_tarif')
                    ->searchable()
                    ->label('Nama Tarif'),
                    TextColumn::make('tarif.tarif')
                    ->badge()
                    ->formatStateUsing(
                        function (TarifToRuangan $tarif) {
                            return 'Rp. ' . number_format($tarif->tarif->tarif);
                        }
                    )
            ])
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make()
            ])
            ->bulkActions([
                // ...
            ])
            ->emptyStateHeading('Tidak Ada Tarif Ditambahkan')
            ->emptyStateDescription('Pastikan Menambahkan Tarif pada Master!')
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        Select::make('tarif_id')
                            ->label('Tarif')
                            ->options(
                                Tarif::all()->pluck('nama_tarif', 'id')
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->action(
                        function (array $data) {

                            try {

                                $user = TarifToRuangan::where('ruangan_id', $this->record->id)->where('tarif_id', $data['tarif_id'])->first();

                                if ($user) {
                                    Notification::make()
                                        ->title('Gagal!')
                                        ->body('Data Sudah ada Pada Ruangan')
                                        ->danger()
                                        ->send();
                                } else {
                                    TarifToRuangan::create([
                                        'tarif_id' => $data['tarif_id'],
                                        'ruangan_id' => $this->record->id,
                                    ]);

                                    Notification::make()
                                        ->title('Berhasil Ditambahkan!')
                                        ->body('Data Berhasil Ditambahkan Kedalam ' . $this->record->nama_ruangan . ' !')
                                        ->success()
                                        ->send();
                                }
                            } catch (\Throwable $th) {
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

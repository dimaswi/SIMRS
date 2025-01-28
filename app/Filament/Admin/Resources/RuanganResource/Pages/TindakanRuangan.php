<?php

namespace App\Filament\Admin\Resources\RuanganResource\Pages;

use App\Filament\Admin\Resources\RuanganResource;
use App\Models\Aplikasi\TindakanToRuangan;
use Filament\Resources\Pages\Page;
use App\Models\Master\Ruangan;
use App\Models\Master\Tindakan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class TindakanRuangan extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = RuanganResource::class;

    protected static string $view = 'filament.admin.resources.ruangan-resource.pages.tindakan-ruangan';

    use HasPageSidebar;

    public Ruangan $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                TindakanToRuangan::where('id_ruangan', $this->record->id)
            )
            ->columns([
                TextColumn::make('index')
                    ->alignCenter()
                    ->rowIndex()
                    ->label('No.')
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('tindakan.nama_tindakan')
                    ->searchable()
                    ->label('Nama Tindakan'),
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
            ->emptyStateHeading('Tidak Ada Tindakan Ditambahkan')
            ->emptyStateDescription('Pastikan Menambahkan Tindakan pada Master!')
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        Select::make('id_tindakan')
                            ->label('User')
                            ->options(
                                Tindakan::all()->pluck('nama_tindakan', 'id')
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->action(
                        function (array $data) {

                            try {

                                $user = TindakanToRuangan::where('id_ruangan', $this->record->id)->where('id_tindakan', $data['id_tindakan'])->first();

                                if ($user) {
                                    Notification::make()
                                        ->title('Gagal!')
                                        ->body('Tindakan Sudah ada Pada Ruangan')
                                        ->danger()
                                        ->send();
                                } else {
                                    TindakanToRuangan::create([
                                        'id_tindakan' => $data['id_tindakan'],
                                        'id_ruangan' => $this->record->id,
                                    ]);

                                    Notification::make()
                                        ->title('Berhasil Ditambahkan!')
                                        ->body('Tindakan Berhasil Ditambahkan Kedalam ' . $this->record->nama_ruangan . ' !')
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

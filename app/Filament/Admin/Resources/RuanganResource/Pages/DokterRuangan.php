<?php

namespace App\Filament\Admin\Resources\RuanganResource\Pages;

use App\Filament\Admin\Resources\RuanganResource;
use App\Models\Aplikasi\DokterToRuangan;
use App\Models\Master\Ruangan;
use App\Models\User;
use Filament\Resources\Pages\Page;
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

class DokterRuangan extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    protected static string $resource = RuanganResource::class;

    protected static string $view = 'filament.admin.resources.ruangan-resource.pages.dokter-ruangan';

    use HasPageSidebar;

    public Ruangan $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                DokterToRuangan::where('ruangan_id', $this->record->id)
            )
            ->columns([
                TextColumn::make('index')
                    ->alignCenter()
                    ->rowIndex()
                    ->label('No.')
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('user.nama')
                    ->searchable()
                    ->label('Nama Dokter'),
                TextColumn::make('jadwal')
                    ->searchable()
                    ->label('Jadwal'),
                TextColumn::make('jam_buka')
                    ->searchable()
                    ->label('Jam')
                    ->badge()
                    ->formatStateUsing(function ($state, DokterToRuangan $dokter) {
                        return $dokter->jam_buka. " - ". $dokter->jam_tutup;
                    }),
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
            ->emptyStateHeading('Tidak Ada Dokter Ditambahkan')
            ->emptyStateDescription('Pastikan Menambahkan User pada Master!')
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        Select::make('user_id')
                            ->label('User')
                            ->options(
                                User::whereIn('pekerjaan', [1, 2])->get()->pluck('nama', 'id')
                            )
                            ->searchable()
                            ->required(),
                        Select::make('jadwal')
                            ->options([
                                'Senin' => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu',
                            ])
                            ->searchable(),
                        TimePicker::make('jam_buka')
                            ->seconds(false),
                        TimePicker::make('jam_tutup')
                            ->seconds(false),
                    ])
                    ->action(
                        function (array $data) {

                            try {

                                $user = DokterToRuangan::where('jadwal', $data['jadwal'])->where('user_id', $data['user_id'])->first();

                                if ($user) {
                                    Notification::make()
                                        ->title('Gagal!')
                                        ->body('Data Sudah ada Pada Ruangan')
                                        ->danger()
                                        ->send();
                                } else {
                                    DokterToRuangan::create([
                                        'user_id' => $data['user_id'],
                                        'ruangan_id' => $this->record->id,
                                        'jadwal' => $data['jadwal'],
                                        'jam_buka' => $data['jam_buka'],
                                        'jam_tutup' => $data['jam_tutup'],
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

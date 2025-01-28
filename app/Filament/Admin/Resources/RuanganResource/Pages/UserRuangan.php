<?php

namespace App\Filament\Admin\Resources\RuanganResource\Pages;

use App\Filament\Admin\Resources\RuanganResource;
use App\Models\Aplikasi\UserToRuangan;
use App\Models\Master\Ruangan;
use App\Models\User;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class UserRuangan extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = RuanganResource::class;

    protected static string $view = 'filament.admin.resources.ruangan-resource.pages.user-ruangan';

    use HasPageSidebar;

    public Ruangan $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(UserToRuangan::where('id_ruangan', $this->record->id))
            ->columns([
                TextColumn::make('index')
                    ->alignCenter()
                    ->rowIndex()
                    ->label('No.')
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('user.nama')
                    ->label('Nama')
                    ->searchable(),
                    TextColumn::make('user.pekerjaanUser.nama_pekerjaan')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('ruangan.nama_ruangan'),
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
            ->emptyStateHeading('Tidak User Ditambahkan')
            ->emptyStateDescription('Pastikan Menambahkan User pada Tab Pengguna!')
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        Select::make('id_user')
                            ->label('User')
                            ->options(
                                User::all()->pluck('nama', 'id')
                            )
                            ->searchable()
                            ->required(),
                    ])
                    ->action(
                        function (array $data) {

                            try {

                                $user = UserToRuangan::where('id_ruangan', $this->record->id)->where('id_user', $data['id_user'])->first();

                                if ($user) {
                                    Notification::make()
                                        ->title('Gagal!')
                                        ->body('User Sudah Berada Pada Ruangan')
                                        ->danger()
                                        ->send();
                                } else {
                                    UserToRuangan::create([
                                        'id_user' => $data['id_user'],
                                        'id_ruangan' => $this->record->id,
                                    ]);

                                    Notification::make()
                                        ->title('Berhasil Ditambahkan!')
                                        ->body('User Berhasil Ditambahkan Kedalam ' . $this->record->nama_ruangan . ' !')
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

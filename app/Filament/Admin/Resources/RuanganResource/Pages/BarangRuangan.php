<?php

namespace App\Filament\Admin\Resources\RuanganResource\Pages;

use App\Filament\Admin\Resources\RuanganResource;
use App\Models\Aplikasi\BarangToRuangan;
use App\Models\Inventory\Barang;
use Filament\Resources\Pages\Page;
use App\Models\Master\Ruangan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class BarangRuangan extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static string $resource = RuanganResource::class;

    protected static string $view = 'filament.admin.resources.ruangan-resource.pages.barang-ruangan';

    use HasPageSidebar;

    public Ruangan $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                BarangToRuangan::where('id_ruangan', $this->record->id)
            )
            ->columns([
                TextColumn::make('index')
                    ->alignCenter()
                    ->rowIndex()
                    ->label('No.')
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('barang.nama_barang')
                    ->searchable()
                    ->label('Nama Barang'),
                TextColumn::make('stok')
                    ->badge()
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
            ->emptyStateHeading('Tidak Ada Barang Ditambahkan')
            ->emptyStateDescription('Pastikan Menambahkan Barang pada Inventory!')
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        Select::make('id_barang')
                            ->label('User')
                            ->options(
                                Barang::all()->pluck('nama_barang', 'id')
                            )
                            ->searchable()
                            ->required(),
                        TextInput::make('stok')
                            ->label('Stok')
                            ->numeric()
                            ->default(0),
                    ])
                    ->action(
                        function (array $data) {

                            try {

                                $user = BarangToRuangan::where('id_ruangan', $this->record->id)->where('id_barang', $data['id_barang'])->first();

                                if ($user) {
                                    Notification::make()
                                        ->title('Gagal!')
                                        ->body('Tindakan Sudah ada Pada Ruangan')
                                        ->danger()
                                        ->send();
                                } else {
                                    BarangToRuangan::create([
                                        'id_barang' => $data['id_barang'],
                                        'id_ruangan' => $this->record->id,
                                        'stok' => $data['stok'],
                                    ]);

                                    Notification::make()
                                        ->title('Berhasil Ditambahkan!')
                                        ->body('Barang Berhasil Ditambahkan Kedalam ' . $this->record->nama_ruangan . ' !')
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

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
                            ->label('Barang6')
                            ->options(
                                Barang::all()->pluck('nama_barang', 'id')
                            )
                            ->multiple()
                            ->searchable()
                            ->required(),
                    ])
                    ->action(
                        function (array $data) {
                            try {

                                foreach ($data['id_barang'] as $key => $value) {
                                    $user = BarangToRuangan::where('id_ruangan', $this->record->id)->where('id_barang', $value)->first();
                                    $barang = Barang::where('id', $value)->first();

                                    if ($user) {
                                        Notification::make()
                                            ->title('Gagal!')
                                            ->body('Barang '. $barang->nama_barang .' Sudah ada Pada Ruangan')
                                            ->danger()
                                            ->send();
                                    } else {
                                        BarangToRuangan::create([
                                            'id_barang' => $value,
                                            'id_ruangan' => $this->record->id,
                                            'stok' => 0,
                                        ]);

                                        Notification::make()
                                            ->title('Berhasil Ditambahkan!')
                                            ->body($barang->nama_barang.' Berhasil Ditambahkan Kedalam ' . $this->record->nama_ruangan . ' !')
                                            ->success()
                                            ->send();
                                    }
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

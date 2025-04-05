<?php

namespace App\Filament\Pembayaran\Resources\PasienResource\Pages;

use App\Filament\Pembayaran\Resources\PasienResource;
use App\Models\Pembayaran\Tagihan;
use App\Models\Pendaftaran\Pendaftaran;
use App\Tables\Columns\Pembayaran\Tagihan\NamaTagihanColumn;
use Filament\Resources\Pages\Page;
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

class TagihanPasien extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.pembayaran.resources.pasien-resource.pages.pembayaran-pasien';

    public Pendaftaran $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(Tagihan::query()->where('pendaftaran_id', $this->record->id)->with(['tindakan', 'barang', 'tarif']))
            ->paginated(false)
            ->columns([
                TextColumn::make('index')
                    ->alignCenter()
                    ->rowIndex()
                    ->label('No.')
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                NamaTagihanColumn::make('nama_tagihan'),
                TextColumn::make('jumlah')
                    ->alignCenter()
                    ->label('Jumlah')
                    ->badge(),
                TextColumn::make('nominal')
                    ->badge()
                    ->formatStateUsing(
                        function (Tagihan $tagihan) {
                            return 'Rp. ' . number_format($tagihan->nominal);
                        }
                    )
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}

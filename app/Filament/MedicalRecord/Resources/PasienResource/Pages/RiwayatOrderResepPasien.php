<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\MedicalRecord\OrderResep;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\Action as ActionsAction;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class RiwayatOrderResepPasien extends Page implements HasForms, HasTable
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.riwayat-order-resep-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    use InteractsWithForms;

    use InteractsWithTable;

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('orderResep')
                ->label('Order Baru')
                ->color('success')
                ->icon('bi-receipt')
                ->url(
                    PasienResource::getUrl('farmasi', ['record' => $this->record->id])
                ),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderResep::query()->where('kunjungan_id', $this->record->id)
            )
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('dokter.nama')
                    ->searchable()
                    ->label('Pemberi Resep'),
                    TextColumn::make('created_at')
                    ->label('Tanggal Order')
                    ->badge()
                    ->sortable()
                    ->dateTime()
                    ->alignEnd()
            ])
            ->actions([
                Action::make('lihat')
                    ->label('Lihat')
                    ->url(
                        function (OrderResep $record) {
                            return PasienResource::getUrl('detailRiwayatOrderResep', ['record' => $record->kunjungan_id, 'orderResep' => $record->id]);
                        }
                    )
                    ->icon('heroicon-o-eye')
                    ->color('primary')
            ])
            ->bulkActions([
                // ...
            ]);
    }
}

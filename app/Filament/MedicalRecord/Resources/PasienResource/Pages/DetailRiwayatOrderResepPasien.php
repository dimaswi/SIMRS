<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\MedicalRecord\OrderResepDetil;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Infolist;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class DetailRiwayatOrderResepPasien extends Page implements HasForms,  HasTable
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.detail-riwayat-order-resep-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    use InteractsWithTable;

    use InteractsWithForms;

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
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderResepDetil::query()->where('order_resep_id', request('orderResep'))->with('obat')
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
                    ->searchable(),
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
            ]);
    }
}

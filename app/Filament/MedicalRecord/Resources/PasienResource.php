<?php

namespace App\Filament\MedicalRecord\Resources;

use App\Filament\MedicalRecord\Resources\PasienResource\Pages;
use App\Filament\MedicalRecord\Resources\PasienResource\RelationManagers;
use App\Models\Pasien;
use App\Models\Pendaftaran\Kunjungan;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class PasienResource extends Resource
{
    protected static ?string $model = Kunjungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pasien';

    protected static ?string $modelLabel = 'Pasien ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                function (Kunjungan $pasien) {
                    return static::getUrl('pemeriksaan', ['record' => $pasien->id]);
                }
            )
            ->modifyQueryUsing(
                function (Builder $query) {
                    return $query->where('final', null);
                }
            )
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('pendaftaran.pasien.nama_lengkap')
                    ->searchable()
                    ->label('Nama Pasien')
                    ->formatStateUsing(function ($state, Kunjungan $kunjungan) {
                        return new HtmlString($kunjungan->pendaftaran->pasien->nama_lengkap . '<b> (' . str_pad($kunjungan->pendaftaran->norm, 6, '0', STR_PAD_LEFT) . ') </b>');
                    }),
                TextColumn::make('ruangan.nama_ruangan')
                    ->badge()
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function sidebar(Kunjungan $record): FilamentPageSidebar
    {
        return FilamentPageSidebar::make()
            ->setNavigationItems([
                PageNavigationItem::make('Diagnosa Pasien')
                    ->url(function () use ($record) {
                        return static::getUrl('diagnosa', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-paper-clip')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.RME.resources.pasiens.diagnosa';
                    }),
                PageNavigationItem::make('Pemeriksaan Umum')
                    ->url(function () use ($record) {
                        return static::getUrl('pemeriksaan', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-clipboard-document-list')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.RME.resources.pasiens.pemeriksaan';
                    }),
                PageNavigationItem::make('Tindakan')
                    ->url(function () use ($record) {
                        return static::getUrl('tindakan', ['record' => $record->id]);
                    })
                    ->icon('healthicons-o-stethoscope')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.RME.resources.pasiens.tindakan';
                    }),
                PageNavigationItem::make('Odontogram')
                    ->url(function () use ($record) {
                        return static::getUrl('odontogram', ['record' => $record->id]);
                    })
                    ->icon('fas-tooth')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.RME.resources.pasiens.odontogram';
                    }),
                PageNavigationItem::make('Farmasi')
                    ->url(function () use ($record) {
                        return static::getUrl('tindakan', ['record' => $record->id]);
                    })
                    ->icon('healthicons-o-pharmacy')
                // ->isActiveWhen(function () {
                //     return request()->route()->action['as'] == 'filament.RME.resources.pasiens.tindakan';
                // })
                ,
                PageNavigationItem::make('Laboratorium')
                    ->url(function () use ($record) {
                        return static::getUrl('tindakan', ['record' => $record->id]);
                    })
                    ->icon('healthicons-f-biochemistry-laboratory')
                // ->isActiveWhen(function () {
                //     return request()->route()->action['as'] == 'filament.RME.resources.pasiens.tindakan';
                // })
                ,
                PageNavigationItem::make('Radiologi')
                    ->url(function () use ($record) {
                        return static::getUrl('tindakan', ['record' => $record->id]);
                    })
                    ->icon('healthicons-f-radiology')
                // ->isActiveWhen(function () {
                //     return request()->route()->action['as'] == 'filament.RME.resources.pasiens.tindakan';
                // })
                ,
                PageNavigationItem::make('Surat')
                    ->url(function () use ($record) {
                        return static::getUrl('tindakan', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-envelope')
                // ->isActiveWhen(function () {
                //     return request()->route()->action['as'] == 'filament.RME.resources.pasiens.tindakan';
                // })
                ,
                PageNavigationItem::make('Pasca Kunjungan')
                    ->url(function () use ($record) {
                        return static::getUrl('tindakan', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-home')
                // ->isActiveWhen(function () {
                //     return request()->route()->action['as'] == 'filament.RME.resources.pasiens.tindakan';
                // })
                ,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'pemeriksaan' => Pages\PemeriksaanPasien::route('/{record}/pemeriksaan'),
            'diagnosa' => Pages\DiagnosaPasien::route('/{record}/diagnosa'),
            'tindakan' => Pages\TindakanPasien::route('/{record}/tindakan'),
            'odontogram' => Pages\OdontogramPasien::route('/{record}/odontogram'),
        ];
    }
}

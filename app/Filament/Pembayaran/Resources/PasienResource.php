<?php

namespace App\Filament\Pembayaran\Resources;

use App\Filament\Pembayaran\Resources\PasienResource\Pages;
use App\Filament\Pembayaran\Resources\PasienResource\RelationManagers;
use App\Models\Pendaftaran\Pendaftaran;
use App\Tables\Columns\Pembayaran\NamaRuanganColumn;
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
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pasien';

    protected static ?string $modelLabel = 'Pembayaran Pasien ';


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
                function (Pendaftaran $pasien) {
                    return static::getUrl('pembayaran', ['record' => $pasien->id]);
                }
            )
            ->columns([
                TextColumn::make('pasien.nama_lengkap')
                ->searchable()
                ->label('Nama Pasien')
                ->formatStateUsing(function ($state, Pendaftaran $pendaftaran) {
                    return new HtmlString($pendaftaran->pasien->nama_lengkap .'<b> ('. str_pad($pendaftaran->pasien->norm, 6, '0', STR_PAD_LEFT) .') </b>');
                }),
                NamaRuanganColumn::make('nama_ruangan')
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
            'edit' => Pages\EditPasien::route('/{record}/edit'),
            'pembayaran' => Pages\TagihanPasien::route('/{record}/pembayaran'),
        ];
    }
}

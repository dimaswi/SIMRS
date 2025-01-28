<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JenisKunjunganResource\Pages;
use App\Filament\Admin\Resources\JenisKunjunganResource\RelationManagers;
use App\Models\Master\JenisKunjungan;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisKunjunganResource extends Resource
{
    protected static ?string $model = JenisKunjungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Jenis Kunjungan';

    protected static ?string $modelLabel = 'Jenis Kunjungan ';

    protected static ?string $navigationGroup = 'Pelayanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_kunjungan')
                        ->label('Nama Jenis Kunjungan')
                        ->placeholder('Masukan Jenis Kunjungan')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->alignCenter()
                    ->rowIndex()
                    ->label('No.')
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('nama_kunjungan')
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ])
            ])
            ->bulkActions([

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
            'index' => Pages\ListJenisKunjungans::route('/'),
            'create' => Pages\CreateJenisKunjungan::route('/create'),
            'edit' => Pages\EditJenisKunjungan::route('/{record}/edit'),
        ];
    }
}

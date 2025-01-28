<?php

namespace App\Filament\Inventory\Resources;

use App\Filament\Inventory\Resources\SatuanBarangResource\Pages;
use App\Filament\Inventory\Resources\SatuanBarangResource\RelationManagers;
use App\Models\Inventory\SatuanBarang;
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

class SatuanBarangResource extends Resource
{
    protected static ?string $model = SatuanBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Satuan Barang';

    protected static ?string $modelLabel = 'Satuan Barang ';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_satuan_barang')
                            ->required()
                            ->label('Nama Satuan')
                            ->placeholder('Masukan Satuan Barang'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('nama_satuan_barang')
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
            'index' => Pages\ListSatuanBarangs::route('/'),
            'create' => Pages\CreateSatuanBarang::route('/create'),
            'edit' => Pages\EditSatuanBarang::route('/{record}/edit'),
        ];
    }
}

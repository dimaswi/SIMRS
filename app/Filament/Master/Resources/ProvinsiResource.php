<?php

namespace App\Filament\Master\Resources;

use App\Filament\Master\Resources\ProvinsiResource\Pages;
use App\Filament\Master\Resources\ProvinsiResource\RelationManagers;
use App\Models\Master\Provinsi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProvinsiResource extends Resource
{
    protected static ?string $model = Provinsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Provinsi';

    protected static ?string $modelLabel = 'Provinsi ';

    protected static ?string $navigationGroup = 'Master';

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
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('name')->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
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
            'index' => Pages\ListProvinsis::route('/'),
            // 'create' => Pages\CreateProvinsi::route('/create'),
            // 'edit' => Pages\EditProvinsi::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Master\Resources;

use App\Filament\Master\Resources\OdontogramGigiResource\Pages;
use App\Filament\Master\Resources\OdontogramGigiResource\RelationManagers;
use App\Models\Master\OdontogramGigi;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OdontogramGigiResource extends Resource
{
    protected static ?string $model = OdontogramGigi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Odontogram';

    protected static ?string $modelLabel = 'Odontogram ';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('simbol')
                        ->placeholder('Masukan Simbol Kondisi ')
                        ->required(),
                    TextInput::make('keterangan')
                        ->placeholder('Masukan Keterangan ')
                        ->required(),
                ])
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
                TextColumn::make('simbol')
                    ->searchable()
                    ->label('Simbol'),
                TextColumn::make('keterangan')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListOdontogramGigis::route('/'),
            'create' => Pages\CreateOdontogramGigi::route('/create'),
            'edit' => Pages\EditOdontogramGigi::route('/{record}/edit'),
        ];
    }
}

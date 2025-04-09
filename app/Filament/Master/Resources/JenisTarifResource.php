<?php

namespace App\Filament\Master\Resources;

use App\Filament\Master\Resources\JenisTarifResource\Pages;
use App\Filament\Master\Resources\JenisTarifResource\RelationManagers;
use App\Models\Master\JenisTarif;
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

class JenisTarifResource extends Resource
{
    protected static ?string $model = JenisTarif::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Jenis Tarif';

    protected static ?string $modelLabel = 'Jenis Tarif ';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_tarif')
                    ->required()
                    ->placeholder('Masukan Nama Jenis Tarif')
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
                TextColumn::make('nama_tarif')
                    ->searchable()
                    ->label('Nama Tarif')
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
            'index' => Pages\ListJenisTarifs::route('/'),
            'create' => Pages\CreateJenisTarif::route('/create'),
            'edit' => Pages\EditJenisTarif::route('/{record}/edit'),
        ];
    }
}

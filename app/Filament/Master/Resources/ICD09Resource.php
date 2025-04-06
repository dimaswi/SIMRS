<?php

namespace App\Filament\Master\Resources;

use App\Filament\Master\Resources\ICD09Resource\Pages;
use App\Filament\Master\Resources\ICD09Resource\RelationManagers;
use App\Models\Master\ICD09;
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

class ICD09Resource extends Resource
{
    protected static ?string $model = ICD09::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'ICD 09';

    protected static ?string $modelLabel = 'ICD 09 ';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('code')
                        ->required(),
                    TextInput::make('display')
                        ->required(),
                    TextInput::make('version')
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
                TextColumn::make('code')
                    ->label('Kode')
                    ->alignCenter()
                    ->searchable()
                    ->badge()
                    ->extraHeaderAttributes([
                        'class' => 'w-2'
                    ]),
                TextColumn::make('display')
                    ->searchable()
                    ->formatStateUsing(
                        function (ICD09 $record) {
                            return $record->display . " - " . $record->version;
                        }
                    )
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
            'index' => Pages\ListICD09S::route('/'),
            'create' => Pages\CreateICD09::route('/create'),
            'edit' => Pages\EditICD09::route('/{record}/edit'),
        ];
    }
}

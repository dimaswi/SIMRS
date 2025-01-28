<?php

namespace App\Filament\Master\Resources;

use App\Filament\Master\Resources\JenisKelaminResource\Pages;
use App\Filament\Master\Resources\JenisKelaminResource\RelationManagers;
use App\Models\Master\JenisKelamin;
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

class JenisKelaminResource extends Resource
{
    protected static ?string $model = JenisKelamin::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Jenis Kelamin';

    protected static ?string $modelLabel = 'Jenis Kelamin ';

    protected static ?string $navigationGroup = 'Master';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_jenis_kelamin')
                        ->placeholder('Masukan Nama Jenis Kelamin')
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
                TextColumn::make('nama_jenis_kelamin')
                    ->searchable()
                    ->label('Jenis kelamin')
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
            'index' => Pages\ListJenisKelamins::route('/'),
            'create' => Pages\CreateJenisKelamin::route('/create'),
            'edit' => Pages\EditJenisKelamin::route('/{record}/edit'),
        ];
    }
}

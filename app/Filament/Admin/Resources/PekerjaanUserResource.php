<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PekerjaanUserResource\Pages;
use App\Filament\Admin\Resources\PekerjaanUserResource\RelationManagers;
use App\Models\Master\PekerjaanUser;
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

class PekerjaanUserResource extends Resource
{
    protected static ?string $model = PekerjaanUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pekerjaan Pengguna';

    protected static ?string $modelLabel = 'Pekerjaan Pengguna ';

    protected static ?string $navigationGroup = 'Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_pekerjaan')
                    ->required()
                    ->placeholder('Masukan Nama Pekerjaan'),
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
                TextColumn::make('nama_pekerjaan'),
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
            'index' => Pages\ListPekerjaanUsers::route('/'),
            'create' => Pages\CreatePekerjaanUser::route('/create'),
            'edit' => Pages\EditPekerjaanUser::route('/{record}/edit'),
        ];
    }
}

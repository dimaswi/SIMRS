<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\Master\PekerjaanUser;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?string $modelLabel = 'Pengguna ';

    protected static ?string $navigationGroup = 'Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make('')->schema([
                    TextInput::make('nama')
                        ->required()
                        ->label('Nama')
                        ->placeholder('Masukan Nama'),
                    TextInput::make('nip')
                        ->required()
                        ->label('NIP')
                        ->placeholder('Masukan NIP'),
                    TextInput::make('password')
                        ->password()
                        ->required(fn(string $operation): bool => $operation === 'create')
                        ->label('Masukan Password')
                        ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                        ->readOnlyOn('edit')
                        ->hiddenOn('edit')
                        ->placeholder('Masukan Password'),
                    Select::make('pekerjaan')
                        ->required()
                        ->label('Pekerjaan')
                        ->searchable()
                        ->options(
                            PekerjaanUser::all()->pluck('nama_pekerjaan', 'id'),
                        )
                ])->columns(2)

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
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pekerjaanUser.nama_pekerjaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nip')
                    ->label('Nomor Induk Pegawai')
                    ->badge()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ])
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

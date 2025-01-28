<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TindakanResource\Pages;
use App\Filament\Admin\Resources\TindakanResource\RelationManagers;
use App\Models\Master\Tindakan;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TindakanResource extends Resource
{
    protected static ?string $model = Tindakan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Tindakan';

    protected static ?string $modelLabel = 'Tindakan ';

    protected static ?string $navigationGroup = 'Pelayanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_tindakan')
                            ->placeholder('Masukan Nama Tindakan')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('tagihan_dokter')
                            ->placeholder('Masukan Tarif Dokter')
                            ->default(0)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),
                        TextInput::make('tagihan_paramedis')
                            ->placeholder('Masukan Tarif Paramedis')
                            ->default(0)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),
                        TextInput::make('tagihan_farmasi')
                            ->placeholder('Masukan Tarif Farmasi')
                            ->default(0)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),
                        TextInput::make('tagihan_sarana')
                            ->placeholder('Masukan Tarif Sarana')
                            ->default(0)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),
                        TextInput::make('tagihan_oksigen')
                            ->placeholder('Masukan Tarif Oksigen')
                            ->default(0)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),
                        Hidden::make('total_tagihan'),
                        Checkbox::make('oksigen')
                            ->inline()
                            ->columnSpanFull()
                    ])->columns(2)
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
                TextColumn::make('nama_tindakan')
                    ->searchable(),
                TextColumn::make('total_tagihan')
                    ->badge()
                    ->formatStateUsing(
                        function (Tindakan $tindakan) {
                            return 'Rp. ' . number_format($tindakan->total_tagihan);
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
            'index' => Pages\ListTindakans::route('/'),
            'create' => Pages\CreateTindakan::route('/create'),
            'edit' => Pages\EditTindakan::route('/{record}/edit'),
        ];
    }
}

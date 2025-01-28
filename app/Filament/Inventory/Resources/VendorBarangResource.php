<?php

namespace App\Filament\Inventory\Resources;

use App\Filament\Inventory\Resources\VendorBarangResource\Pages;
use App\Filament\Inventory\Resources\VendorBarangResource\RelationManagers;
use App\Models\Inventory\VendorBarang;
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

class VendorBarangResource extends Resource
{
    protected static ?string $model = VendorBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Vendor';

    protected static ?string $modelLabel = 'Vendor ';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_vendor')
                        ->required()
                        ->placeholder('Nama Vendor Barang'),
                    TextInput::make('alamat')
                        ->required()
                        ->placeholder('Alamat Vendor Barang'),
                    TextInput::make('nomor_telefon')
                        ->placeholder('Telefon Vendor Barang'),
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
                TextColumn::make('nama_vendor')
                    ->searchable()
                    ->label('Nama Vendor Barang'),
                TextColumn::make('alamat'),
                TextColumn::make('nomor_telefon')
                    ->badge(),
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
            'index' => Pages\ListVendorBarangs::route('/'),
            'create' => Pages\CreateVendorBarang::route('/create'),
            'edit' => Pages\EditVendorBarang::route('/{record}/edit'),
        ];
    }
}

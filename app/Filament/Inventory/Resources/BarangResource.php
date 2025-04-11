<?php

namespace App\Filament\Inventory\Resources;

use App\Filament\Inventory\Resources\BarangResource\Pages;
use App\Filament\Inventory\Resources\BarangResource\RelationManagers;
use App\Models\Inventory\Barang;
use App\Models\Inventory\JenisBarang;
use App\Models\Inventory\KategoriBarang;
use App\Models\Inventory\SatuanBarang;
use App\Models\Inventory\VendorBarang;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
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
use Illuminate\Support\HtmlString;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Barang';

    protected static ?string $modelLabel = 'Barang ';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_barang')
                            ->required()
                            ->placeholder('Nama Barang'),
                        TextInput::make('merk')
                            ->required()
                            ->placeholder('Merk Barang'),
                        TextInput::make('harga_beli')
                            ->placeholder('Masukan Harga Beli')
                            ->default(0)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),
                        TextInput::make('harga_jual')
                            ->placeholder('Masukan Harga Jual')
                            ->default(0)
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),
                        TextInput::make('stok_minimum')
                            ->numeric()
                            ->placeholder('Masukan Stok Minimum')
                            ->required(),
                        Select::make('jenis')
                            ->required()
                            ->preload()
                            ->relationship(name: 'jenisBarang', titleAttribute: 'nama_jenis_barang')
                            ->createOptionForm([
                                TextInput::make('nama_jenis_barang')
                                    ->required()
                                    ->label('Nama Jenis')
                                    ->placeholder('Masukan Jenis Barang')
                            ])
                            // ->options(
                            //     JenisBarang::all()->pluck('nama_jenis_barang', 'id')
                            // )
                            ->searchable(),
                        // ->hint(new HtmlString('<a href="/inventory/jenis-barangs/create" target="blank">tambah <b>jenis barang</b>?</a>')),
                        Select::make('kategori')
                            ->required()
                            ->preload()
                            ->relationship(name: 'KategoriBarang', titleAttribute: 'nama_kategori_barang')
                            ->createOptionForm([
                                TextInput::make('nama_kategori_barang')
                                    ->required()
                                    ->label('Nama Kategori')
                                    ->placeholder('Masukan Kategori Barang')
                            ])
                            // ->options(
                            //     KategoriBarang::all()->pluck('nama_kategori_barang', 'id')
                            // )
                            ->searchable(),
                        // ->hint(new HtmlString('<a href="/inventory/kategori-barangs/create" target="blank">tambah <b>kategori barang</b>?</a>')),
                        Select::make('vendor')
                            ->required()
                            ->preload()
                            ->relationship(name: 'vendorBarang', titleAttribute: 'nama_vendor')
                            ->createOptionForm([
                                TextInput::make('nama_vendor')
                                    ->required()
                                    ->placeholder('Nama Vendor Barang'),
                                TextInput::make('alamat')
                                    ->required()
                                    ->placeholder('Alamat Vendor Barang'),
                                TextInput::make('nomor_telefon')
                                    ->placeholder('Telefon Vendor Barang'),
                            ])
                            // ->options(
                            //     SatuanBarang::all()->pluck('nama_satuan_barang', 'id')
                            // )
                            ->searchable(),
                        // ->hint(new HtmlString('<a href="/inventory/satuan-barangs/create" target="blank">tambah <b>satuan barang</b>?</a>')),
                        Select::make('satuan')
                            ->required()
                            ->preload()
                            ->relationship(name: 'satuanBarang', titleAttribute: 'nama_satuan_barang')
                            ->createOptionForm([
                                TextInput::make('nama_satuan_barang')
                                    ->required()
                                    ->label('Nama Satuan')
                                    ->placeholder('Masukan Satuan Barang')
                            ])
                            // ->options(
                            //     VendorBarang::all()->pluck('nama_vendor', 'id')
                            // )
                            ->searchable(),
                        // ->hint(new HtmlString('<a href="/inventory/vendor-barangs/create" target="blank">tambah <b>vendor barang</b>?</a>')),
                        TextInput::make('generik')
                            ->placeholder('Generik Barang'),
                        Select::make('jenis_penggunaan')
                            ->options([
                                'Obat Dalam' => 'Obat Dalam',
                                'Obat Luar' => 'Obat Luar',
                            ])
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
                TextColumn::make('nama_barang')
                    ->searchable(),
                TextColumn::make('merk')
                    ->searchable(),
                TextColumn::make('kategoriBarang.nama_kategori_barang')
                    ->searchable(),
                TextColumn::make('satuanBarang.nama_satuan_barang')
                    ->searchable(),
                TextColumn::make('jenisBarang.nama_jenis_barang')
                    ->searchable(),
                TextColumn::make('vendorBarang.nama_vendor')
                    ->searchable(),
                TextColumn::make('harga_beli')
                    ->badge()
                    ->formatStateUsing(
                        function (Barang $barang) {
                            return 'Rp. ' . number_format($barang->harga_beli);
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}

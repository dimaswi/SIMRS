<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RuanganResource\Pages;
use App\Filament\Admin\Resources\RuanganResource\RelationManagers;
use App\Models\Master\JenisKunjungan;
use App\Models\Master\Kelas;
use App\Models\Master\Ruangan;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
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

class RuanganResource extends Resource
{
    protected static ?string $model = Ruangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Ruangan';

    protected static ?string $modelLabel = 'Ruangan ';

    protected static ?string $navigationGroup = 'Pelayanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_ruangan')
                        ->required()
                        ->placeholder('Masukan Nama Ruangan')
                        ->columnSpanFull(),
                    Select::make('kelas')
                        ->options(
                            Kelas::all()->pluck('kelas', 'id')
                        )
                        ->searchable()
                        ->required(),
                    Select::make('jenis_kunjungan')
                        ->options(
                            JenisKunjungan::all()->pluck('nama_kunjungan', 'id')
                        )
                        ->searchable()
                        ->required(),
                    Checkbox::make('rawat_inap')->inline()->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex()
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('nama_ruangan')
                    ->searchable(),
                TextColumn::make('kelasRuangan.kelas')
                    ->badge(),
                TextColumn::make('jenisKunjungan.nama_kunjungan')
                    ->searchable(),
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

    public static function sidebar(Ruangan $record): FilamentPageSidebar
    {
        return FilamentPageSidebar::make()
            ->setNavigationItems([
                PageNavigationItem::make('Edit Ruangan')
                    ->url(function () use ($record) {
                        return static::getUrl('edit', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-pencil-square')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.admin.resources.ruangans.edit';
                    }),
                PageNavigationItem::make('User Ruangan')
                    ->url(function () use ($record) {
                        return static::getUrl('user', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-user-group')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.admin.resources.ruangans.user';
                    }),
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
            'index' => Pages\ListRuangans::route('/'),
            'create' => Pages\CreateRuangan::route('/create'),
            'edit' => Pages\EditRuangan::route('/{record}/edit'),
            'user' => Pages\UserRuangan::route('/{record}/user'),
        ];
    }
}

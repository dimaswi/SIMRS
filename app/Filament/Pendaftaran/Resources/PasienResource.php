<?php

namespace App\Filament\Pendaftaran\Resources;

use App\Filament\Pendaftaran\Resources\PasienResource\Pages;
use App\Filament\Pendaftaran\Resources\PasienResource\RelationManagers;
use App\Models\Master\Agama;
use App\Models\Master\JenisKelamin;
use App\Models\Master\Kabupaten;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use App\Models\Master\Pasien;
use App\Models\Master\Pekerjaan;
use App\Models\Master\Pendidikan;
use App\Models\Master\Provinsi;
use App\Models\Master\Wilayah;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pasien';

    protected static ?string $modelLabel = 'Pasien ';

    protected static ?string $recordRouteKeyName = 'id';

    public static function form(Form $form): Form
    {
        $data_pasien = Pasien::orderBy('created_at', 'desc')->first();

        if ($data_pasien == null) {
            $norm = 1;
        } else {
            $norm = $data_pasien->norm + 1;
        }
        return $form
            ->schema([
                Card::make()->schema([
                    Section::make('Data Pasien')
                        ->description('Data Umum Pasien')
                        ->schema([
                            TextInput::make('norm')
                                ->default($norm)
                                ->label('Nomor Rekam Medis')
                                ->columnSpanFull()
                                ->required()
                                ->readOnly(),
                            TextInput::make('gelar_depan')
                                ->placeholder('Gelar Depan')
                                ->hiddenLabel()
                                ->columnSpan(1),
                            TextInput::make('nama_lengkap')
                                ->required()
                                ->placeholder('Nama Lengkap')
                                ->hiddenLabel()->columnSpan(3),
                            TextInput::make('gelar_belakang')
                                ->placeholder('Gelar Belakang')
                                ->hiddenLabel()
                                ->columnSpan(2),
                            TextInput::make('nama_panggilan')
                                ->placeholder('Nama Panggilan')
                                ->hiddenLabel()
                                ->columnSpan(2),
                            TextInput::make('nama_ibu')
                                ->placeholder('Nama Ibu')
                                ->hiddenLabel()
                                ->columnSpan(4),
                            Select::make('tempat_lahir')
                                ->hiddenLabel()
                                ->selectablePlaceholder(false)
                                ->searchable()
                                ->required()
                                ->options(Kabupaten::all()->pluck('name', 'id'))
                                ->columnSpan(2)
                                ->placeholder('Tempat Lahir'),
                            DatePicker::make('tanggal_lahir')
                                ->placeholder('Tanggal Lahir')
                                ->columnSpan(2)
                                ->required()
                                ->hiddenLabel(),
                            Select::make('agama')
                                ->searchable()
                                ->hiddenLabel()
                                ->options(Agama::all()->pluck('nama_agama', 'id'))
                                ->columnSpan(2)
                                ->placeholder('Agama'),
                            Select::make('jenis_kelamin')
                                ->searchable()
                                ->hiddenLabel()
                                ->options(JenisKelamin::all()->pluck('nama_jenis_kelamin', 'id'))
                                ->columnSpan(2)
                                ->placeholder('Jenis Kelamin'),
                            Select::make('pekerjaan')
                                ->searchable()
                                ->hiddenLabel()
                                ->options(Pekerjaan::all()->pluck('nama_pekerjaan', 'id'))
                                ->columnSpan(2)
                                ->placeholder('Pekerjaan'),
                            Select::make('pendidikan')
                                ->searchable()
                                ->hiddenLabel()
                                ->options(Pendidikan::all()->pluck('nama_pendidikan', 'id'))
                                ->columnSpan(2)
                                ->placeholder('Pendidikan'),
                        ])->columns(8)->collapsible(),
                    Section::make('Alamat Pasien')
                        ->description('Data Tempat Tinggal Pasien')
                        ->schema([
                            Textarea::make('alamat')
                                ->required()
                                ->hiddenLabel()
                                ->placeholder('Alamat Pasien')
                                ->columnSpanFull(),
                            Select::make('provinsi')
                                ->searchable()
                                ->hiddenLabel()
                                ->placeholder('Provinsi')
                                ->options(Provinsi::all()->pluck('name', 'id'))
                                ->live()
                                ->required()
                                ->columnSpan(2),
                            Select::make('kabupaten')
                                ->searchable()
                                ->hiddenLabel()
                                ->placeholder('Kabupaten')
                                ->live()
                                ->required()
                                ->options(
                                    function (callable $get) {
                                        $kabupaten = Kabupaten::where('province_id', $get('provinsi'))->get()->pluck('name', 'id');

                                        if ($get('provinsi') == null) {
                                            return null;
                                        }

                                        return $kabupaten;
                                    }
                                )
                                ->columnSpan(2),
                            Select::make('kecamatan')
                                ->searchable()
                                ->hiddenLabel()
                                ->placeholder('Kecamatan')
                                ->live()
                                ->required()
                                ->options(
                                    function (callable $get) {
                                        $kecamatan = Kecamatan::where('regency_id', $get('kabupaten'))->get()->pluck('name', 'id');

                                        if ($get('kabupaten') == null) {
                                            return null;
                                        }

                                        return $kecamatan;
                                    }
                                )
                                ->columnSpan(2),
                            Select::make('kelurahan')
                                ->searchable()
                                ->hiddenLabel()
                                ->placeholder('Kelurahan')
                                ->live()
                                ->required()
                                ->options(
                                    function (callable $get) {
                                        $kelurahan = Kelurahan::where('district_id', $get('kecamatan'))->get()->pluck('name', 'id');

                                        if ($get('kecamatan') == null) {
                                            return null;
                                        }

                                        return $kelurahan;
                                    }
                                )
                                ->columnSpan(2),
                            TextInput::make('nomor_telepon')
                                ->placeholder('Nomor Telepon')
                                ->hiddenLabel()
                                ->required()
                                ->columnSpanFull()
                        ])->columns(8)->collapsible(),
                    // Section::make('Keluarga Pasien')
                    //     ->relationship('keluargaPasien')
                    //     ->description('Data Keluarga Pasien')
                    //     ->schema([
                    //         Hidden::make('norm')->default($norm),
                    //         TextInput::make('nama_keluarga')
                    //             ->required()
                    //             ->placeholder('Nama Keluarga')
                    //             ->hiddenLabel()
                    //             ->columnSpan(2),
                    //         Select::make('hubungan')
                    //             ->searchable()
                    //             ->required()
                    //             ->placeholder('Hubungan')
                    //             ->hiddenLabel()
                    //             ->options([
                    //                 'Orang Tua' => 'Orang Tua',
                    //                 'Anak' => 'Anak',
                    //                 'Istri' => 'Istri',
                    //                 'Suami' => 'Suami',
                    //                 'Kakak' => 'Kakak',
                    //                 'Adik' => 'Adik',
                    //                 'Anak Kandung' => 'Anak Kandung',
                    //                 'Anak Angkat' => 'Anak Angkat',
                    //                 'Lainnya' => 'Lainnya',
                    //             ])
                    //             ->columnSpan(2),
                    //         Select::make('agama')
                    //             ->searchable()
                    //             ->hiddenLabel()
                    //             ->options([
                    //                 'Islam' => 'Islam',
                    //                 'Kristen Protestan' => 'Kristen Protestan',
                    //                 'Kristen Khatolik' => 'Kristen Khatolik',
                    //                 'Hindu' => 'Hindu',
                    //                 'Budha' => 'Budha',
                    //                 'Kong Hu Chu' => 'Kong Hu Chu',
                    //                 'Tidak diketahui' => 'Tidak diketahui',
                    //             ])
                    //             ->columnSpan(2)
                    //             ->placeholder('Agama'),
                    //         Select::make('jenis_kelamin')
                    //             ->searchable()
                    //             ->hiddenLabel()
                    //             ->options([
                    //                 'Laki - Laki' => 'Laki -Laki',
                    //                 'Perempuan' => 'Perempuan',
                    //             ])
                    //             ->columnSpan(2)
                    //             ->placeholder('Jenis Kelamin'),
                    //         Select::make('tempat_lahir')
                    //             ->hiddenLabel()
                    //             ->selectablePlaceholder(false)
                    //             ->searchable()
                    //             ->options(Kabupaten::all()->pluck('name', 'id'))
                    //             ->columnSpan(4)
                    //             ->placeholder('Tempat Lahir'),
                    //         DatePicker::make('tanggal_lahir')
                    //             ->placeholder('Tanggal Lahir')
                    //             ->columnSpan(4)
                    //             ->hiddenLabel(),
                    //         Textarea::make('alamat')
                    //             ->hiddenLabel()
                    //             ->placeholder('Alamat Pasien')
                    //             ->columnSpanFull(),
                    //         Select::make('provinsi')
                    //             ->searchable()
                    //             ->hiddenLabel()
                    //             ->placeholder('Provinsi')
                    //             ->options(Provinsi::all()->pluck('name', 'id'))
                    //             ->live()
                    //             ->columnSpan(2),
                    //         Select::make('kabupaten')
                    //             ->searchable()
                    //             ->hiddenLabel()
                    //             ->placeholder('Kabupaten')
                    //             ->live()
                    //             ->options(
                    //                 function (callable $get) {
                    //                     $kabupaten = Kabupaten::where('province_id', $get('provinsi'))->get()->pluck('name', 'id');

                    //                     if ($get('provinsi') == null) {
                    //                         return null;
                    //                     }

                    //                     return $kabupaten;
                    //                 }
                    //             )
                    //             ->columnSpan(2),
                    //         Select::make('kecamatan')
                    //             ->searchable()
                    //             ->hiddenLabel()
                    //             ->placeholder('Kecamatan')
                    //             ->live()
                    //             ->options(
                    //                 function (callable $get) {
                    //                     $kecamatan = Kecamatan::where('regency_id', $get('kabupaten'))->get()->pluck('name', 'id');

                    //                     if ($get('kabupaten') == null) {
                    //                         return null;
                    //                     }

                    //                     return $kecamatan;
                    //                 }
                    //             )
                    //             ->columnSpan(2),
                    //         Select::make('kelurahan')
                    //             ->searchable()
                    //             ->hiddenLabel()
                    //             ->placeholder('Kelurahan')
                    //             ->live()
                    //             ->options(
                    //                 function (callable $get) {
                    //                     $kelurahan = Kelurahan::where('district_id', $get('kecamatan'))->get()->pluck('name', 'id');

                    //                     if ($get('kecamatan') == null) {
                    //                         return null;
                    //                     }

                    //                     return $kelurahan;
                    //                 }
                    //             )
                    //             ->columnSpan(2),
                    //         TextInput::make('nomor_telepon')
                    //             ->placeholder('Nomor Telepon')
                    //             ->hiddenLabel()
                    //             ->columnSpanFull()
                    //     ])->columns(8)->collapsible()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(
                function (Pasien $pasien) {
                    return static::getUrl('daftar', ['record' => $pasien->id]);
                }
            )
            ->columns([
                Split::make([
                    Stack::make([
                        TextColumn::make('nama_lengkap')
                            ->searchable()
                            ->weight(FontWeight::Bold)
                            ->formatStateUsing(function ($state, Pasien $pasien) {
                                return ($pasien->gelar_depan != null ? $pasien->gelar_depan.'.' : '') . $pasien->nama_lengkap. ($pasien->gelar_belakang != null ? ','.$pasien->gelar_belakang : '');
                            }),
                        TextColumn::make('norm')
                            ->searchable()
                            ->badge()
                            ->formatStateUsing(function ($state, Pasien $pasien) {
                                return str_pad($pasien->norm, 6, '0', STR_PAD_LEFT);
                            }),
                        TextColumn::make('tanggal_lahir')
                            ->formatStateUsing(function ($state, Pasien $pasien) {

                                return Carbon::parse($pasien->tanggal_lahir)->diff(Carbon::now())->format('%y Tahun %m Bulan and %d Hari');
                            }),
                    ]),
                    Stack::make([
                        TextColumn::make('nama_ibu')
                            ->weight(FontWeight::Bold),
                        TextColumn::make('alamat'),
                        TextColumn::make('kelurahan')
                            ->formatStateUsing(function ($state, Pasien $pasien) {
                                return $pasien->Kelurahan->name . ' / ' . $pasien->Kecamatan->name . ' / ' . $pasien->Kabupaten->name;
                            }),
                    ])
                ]),
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

    public static function sidebar(Pasien $record): FilamentPageSidebar
    {
        return FilamentPageSidebar::make()
            ->setNavigationItems([
                PageNavigationItem::make('Pendaftaran Pasien')
                    ->url(function () use ($record) {
                        return static::getUrl('daftar', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-clipboard-document-list')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.pendaftaran.resources.pasiens.daftar';
                    }),
                PageNavigationItem::make('Edit Pasien')
                    ->url(function () use ($record) {
                        return static::getUrl('edit', ['record' => $record->id]);
                    })
                    ->icon('heroicon-o-pencil-square')
                    ->isActiveWhen(function () {
                        return request()->route()->action['as'] == 'filament.pendaftaran.resources.pasiens.edit';
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
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
            'daftar' => Pages\PendaftaranPasien::route('/{record}/daftar'),
        ];
    }
}

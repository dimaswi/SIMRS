<?php

namespace App\Filament\Pendaftaran\Resources\PasienResource\Pages;

use App\Filament\Pendaftaran\Resources\PasienResource;
use App\Models\Master\HubunganPasien;
use App\Models\Master\KeluargaPasien as MasterKeluargaPasien;
use App\Models\Master\Pasien;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class KeluargaPasien extends Page implements HasForms, HasTable
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.pendaftaran.resources.pasien-resource.pages.keluarga-pasien';

    public Pasien $record;

    use HasPageSidebar;

    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(MasterKeluargaPasien::where('norm',  $this->record->norm))
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'style' => 'width:5%'
                    ]),
                TextColumn::make('hubunganPasien.nama_hubungan'),
                TextColumn::make('nama_keluarga'),
                TextColumn::make('alamat'),
                TextColumn::make('nomor_telepon'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema(
                    [
                        TextInput::make('nama_keluarga')
                            ->required()
                            ->placeholder('Nama Keluarga')
                            ->columnSpan(4),
                        Select::make('hubungan')
                            ->options(HubunganPasien::all()->pluck('nama_hubungan', 'id'))
                            ->columnSpan(4),
                        Textarea::make('alamat')
                            ->required()
                            ->placeholder('Masukan Alamat Keluarga Pasien')
                            ->columnSpanFull(),
                        TextInput::make('nomor_telepon')
                            ->required()
                            ->placeholder('Nomor Telepon')
                            ->columnSpanFull(),
                    ]
                )->columns(8)
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        MasterKeluargaPasien::create([
            'norm' => $this->record->norm,
            'nama_keluarga' => $this->form->getState()['nama_keluarga'],
            'hubungan' => $this->form->getState()['hubungan'],
            'alamat' => $this->form->getState()['alamat'],
            'nomor_telepon' => $this->form->getState()['nomor_telepon'],
        ]);

        Notification::make()
            ->title('Berhasil Ditambahkan!')
            ->body('Data Keluarga Pasien Berhasil Ditambahkan!')
            ->success()
            ->send();

        $this->dispatch('close-modal', id: 'tambah-keluarga');
    }
}

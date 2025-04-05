<?php

namespace App\Filament\Pendaftaran\Resources\PasienResource\Pages;

use App\Filament\Pendaftaran\Resources\PasienResource;
use App\Models\Master\JenisKartuIdentitas;
use App\Models\Master\KartuIdentitasPasien;
use App\Models\Master\Pasien;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
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

class IdentitasPasien extends Page implements HasForms, HasTable
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.pendaftaran.resources.pasien-resource.pages.identitas-pasien';

    public Pasien $record;

    use HasPageSidebar;

    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(KartuIdentitasPasien::where('norm',  $this->record->norm))
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'style' => 'width:5%'
                    ]),
                TextColumn::make('jenisKartu.nama_kartu'),
                TextColumn::make('nomor_kartu'),
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
                        Select::make('jenis_kartu')
                            ->options(JenisKartuIdentitas::all()->pluck('nama_kartu', 'id'))
                            ->columnSpan(4),
                        TextInput::make('nomor_kartu')
                            ->required()
                            ->placeholder('Nomor nomor_kartu')
                            ->columnSpan(4),
                    ]
                )->columns(8)
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        KartuIdentitasPasien::create([
            'norm' => $this->record->norm,
            'jenis_kartu' => $this->form->getState()['jenis_kartu'],
            'nomor_kartu' => $this->form->getState()['nomor_kartu'],
        ]);

        Notification::make()
            ->title('Berhasil Ditambahkan!')
            ->body('Data Identitas Pasien Berhasil Ditambahkan!')
            ->success()
            ->send();

        $this->dispatch('close-modal', id: 'tambah-identitas');
    }
}

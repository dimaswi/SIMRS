<?php

namespace App\Filament\MedicalRecord\Resources\PasienResource\Pages;

use App\Filament\MedicalRecord\Resources\PasienResource;
use App\Models\Master\ICD10;
use App\Models\MedicalRecord\Diagnosa;
use App\Models\Pendaftaran\Kunjungan;
use Filament\Resources\Pages\Page;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class DiagnosaPasien extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.medical-record.resources.pasien-resource.pages.diagnosa-pasien';

    use HasPageSidebar;

    public Kunjungan $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(Diagnosa::query()->where('kunjungan_id', $this->record->id))
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('No.')
                    ->alignCenter()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('code')
                    ->label('Kode')
                    ->alignCenter()
                    ->badge()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->alignCenter()
                    ->badge()
                    ->extraHeaderAttributes([
                        'class' => 'w-1'
                    ]),
                TextColumn::make('keterangan'),
            ])
            ->emptyStateHeading('Tidak Ada Diagnosa Ditambahkan')
            ->emptyStateDescription('Pastikan Menambahkan ICD 10 pada Master!')
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ])
            ->headerActions([
                Action::make('tambah')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        Select::make('diagnosa_id')
                            ->label('Diagnosa')
                            ->searchDebounce(1000)
                            ->options(
                                function (callable $get) {
                                    $diagnosa = ICD10::where('code', '!=', null)
                                        ->get()
                                        ->mapWithKeys(function ($diagnosa) {
                                            return [$diagnosa->id => $diagnosa->code . " ( " . $diagnosa->display . " ) "];
                                        })->toArray();
                                    return $diagnosa;
                                }
                            )
                            ->searchable()
                            ->required(),
                    ])
            ]);
    }
}

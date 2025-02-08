<?php

namespace App\Filament\Pendaftaran\Resources\PasienResource\Pages;

use App\Filament\Pendaftaran\Resources\PasienResource;
use App\Models\Master\Pasien;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;

class PendaftaranPasien extends Page implements HasForms
{
    protected static string $resource = PasienResource::class;

    protected static string $view = 'filament.pendaftaran.resources.pasien-resource.pages.pendaftaran-pasien';

    use HasPageSidebar;

    public Pasien $record;

    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('ruangan')
                ])
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }
}

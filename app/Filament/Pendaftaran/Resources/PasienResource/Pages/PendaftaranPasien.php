<?php

namespace App\Filament\Pendaftaran\Resources\PasienResource\Pages;

use App\Filament\Pendaftaran\Resources\PasienResource;
use App\Models\Aplikasi\DokterToRuangan;
use App\Models\Aplikasi\TarifToRuangan;
use App\Models\Master\Pasien;
use App\Models\Master\Ruangan;
use App\Models\Pembayaran\Tagihan;
use App\Models\Pendaftaran\Kunjungan;
use App\Models\Pendaftaran\Pendaftaran;
use App\Models\User;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Carbon\Carbon;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                        ->options(Ruangan::all()->pluck('nama_ruangan', 'id'))
                        ->live()
                        ->searchable()
                        ->required(),
                    Select::make('dokter_ruangan')
                        ->live()
                        ->required()
                        ->searchable()
                        ->options(
                            function (callable $get) {
                                $dokter = DokterToRuangan::where('ruangan_id', $get('ruangan'))
                                    ->with('user')
                                    ->get()
                                    ->mapWithKeys(function ($jadwal) {
                                        return [$jadwal->id => $jadwal->user->nama . ' - ' . $jadwal->jadwal . "  (" . $jadwal->jam_buka . " - " . $jadwal->jam_tutup . ")"];
                                    })->toArray();
                                if ($get('ruangan') == null) {
                                    return null;
                                }
                                return $dokter;
                            }
                        )
                ])
            ])
            ->statePath('data');
    }

    // public function create()
    // {
    //     // dd($this->form->getState());

    //     try {
    //         $pendaftaran = Pendaftaran::where('norm', $this->record->norm)->first();
    //         $ruangan = Ruangan::where('id', $this->form->getState()['ruangan'])->first();
    //         $available_data = Pendaftaran::where('norm', $this->record->norm)
    //             ->with('daf_kunjungan', function ($query) {
    //                 $query->where('final', null);
    //             })
    //             ->get();
    //         $tarif_ruangan = TarifToRuangan::where('ruangan_id', $this->form->getState()['ruangan'])->where('jenis_tarif_id', 1)->with(['tarif', 'ruangan'])->first();

    //         if ($available_data->count() == 0 && $tarif_ruangan != null) {
    //             $dokter = DokterToRuangan::where('id', $this->form->getState()['dokter_ruangan'])->first();

    //             DB::beginTransaction();
    //             $daf = Pendaftaran::create([
    //                 'norm' => $this->record->norm,
    //                 'pendaftar' => auth()->user()->id,
    //                 'baru' => $pendaftaran != null ? 0 : 1
    //             ]);

    //             $kunjungan = Kunjungan::create([
    //                 'pendaftaran_id' => $daf->id,
    //                 'ruangan_id' => $this->form->getState()['ruangan'],
    //                 'dokter_id' => $dokter->user_id,
    //                 'masuk' => Carbon::now('Asia/Jakarta')
    //             ]);

    //             Tagihan::create([
    //                 'pendaftaran_id' => $daf->id,
    //                 'kunjungan_id' => $kunjungan->id,
    //                 'tarif_id' => $tarif_ruangan->id,
    //                 'nominal' => $tarif_ruangan->tarif->tarif,
    //                 'jumlah' => 1,
    //             ]);
    //             DB::commit();

    //             Notification::make()
    //                 ->title('Berhasil!')
    //                 ->body($this->record->nama_lengkap . ' Berhasil didaftarkan ke ' . $ruangan->nama_ruangan)
    //                 ->success()
    //                 ->send();

    //             return redirect('pendaftaran/pasiens');
    //         } else {
    //             if ($available_data != null) {
    //                 Notification::make()
    //                     ->title('Gagal!')
    //                     ->body($this->record->nama_lengkap . ' masih memiliki kunjungan yang belum difinal!')
    //                     ->danger()
    //                     ->send();
    //             }

    //             if ($tarif_ruangan == null) {
    //                 Notification::make()
    //                     ->title('Gagal!')
    //                     ->body('Ruangan belum memiliki tarif administrasi!')
    //                     ->danger()
    //                     ->send();
    //             }
    //         }
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         Notification::make()
    //             ->title('Gagal!')
    //             ->body($th->getMessage())
    //             ->danger()
    //             ->send();
    //     }
    // }

    public function create()
    {
        try {
            $pendaftaran = Pendaftaran::where('norm', $this->record->norm)->first();
            $ruangan = Ruangan::find($this->form->getState()['ruangan']);
            $tarif_ruangan = TarifToRuangan::where('ruangan_id', $ruangan->id)
                ->where('jenis_tarif_id', 1)
                ->with(['tarif', 'ruangan'])
                ->first();

            if (!$ruangan || !$tarif_ruangan) {
                Notification::make()
                    ->title('Gagal!')
                    ->body('Ruangan atau tarif administrasi tidak valid!')
                    ->danger()
                    ->send();
                return;
            }

            $hasPendingVisit = Pendaftaran::where('norm', $this->record->norm)
                ->whereHas('daf_kunjungan', fn($query) => $query->whereNull('final'))
                ->exists();

            if ($hasPendingVisit) {
                Notification::make()
                    ->title('Gagal!')
                    ->body($this->record->nama_lengkap . ' masih memiliki kunjungan yang belum difinal!')
                    ->danger()
                    ->send();
                return;
            }

            DB::beginTransaction();

            $daf = Pendaftaran::create([
                'norm' => $this->record->norm,
                'pendaftar' => auth()->user()->id,
                'baru' => $pendaftaran ? 0 : 1,
            ]);

            $dokter = DokterToRuangan::find($this->form->getState()['dokter_ruangan']);
            $kunjungan = Kunjungan::create([
                'pendaftaran_id' => $daf->id,
                'ruangan_id' => $ruangan->id,
                'dokter_id' => $dokter->user_id,
                'masuk' => Carbon::now(),
            ]);

            Tagihan::create([
                'pendaftaran_id' => $daf->id,
                'kunjungan_id' => $kunjungan->id,
                'tarif_id' => $tarif_ruangan->id,
                'nominal' => $tarif_ruangan->tarif->tarif,
                'jumlah' => 1,
            ]);

            DB::commit();

            Notification::make()
                ->title('Berhasil!')
                ->body($this->record->nama_lengkap . ' Berhasil didaftarkan ke ' . $ruangan->nama_ruangan)
                ->success()
                ->send();

            return redirect()->route('pendaftaran.pasiens');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error saat pendaftaran pasien: ' . $th->getMessage());
            Notification::make()
                ->title('Gagal!')
                ->body('Terjadi kesalahan: ' . $th->getMessage())
                ->danger()
                ->send();
        }
    }
}

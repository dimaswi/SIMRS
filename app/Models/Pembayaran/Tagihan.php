<?php

namespace App\Models\Pembayaran;

use App\Models\Aplikasi\TarifToRuangan;
use App\Models\Inventory\Barang;
use App\Models\Master\Tarif;
use App\Models\Master\Tindakan;
use App\Models\MedicalRecord\Tindakan as MedicalRecordTindakan;
use App\Models\Pendaftaran\Kunjungan;
use App\Models\Pendaftaran\Pendaftaran;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'pembayaran';

    protected $table = 'tagihan';

    protected $fillable = [
        'pendaftaran_id',
        'kunjungan_id',
        'tarif_id',
        'tindakan_id',
        'barang_id',
        'nominal',
        'jumlah',
    ];

    public function tindakan()
    {
        return $this->belongsTo(MedicalRecordTindakan::class, 'tindakan_id');
    }

    public function tarif()
    {
        return $this->belongsTo(TarifToRuangan::class, 'tarif_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }
}

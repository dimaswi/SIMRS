<?php

namespace App\Models\MedicalRecord;

use App\Models\Master\OdontogramGigi;
use App\Models\Pendaftaran\Kunjungan;
use App\Models\Pendaftaran\Pendaftaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odontogram extends Model
{
    use HasFactory;

    protected $connection = 'rekam_medis';

    protected $table = 'odontogram';

    protected $fillable = [
        'kunjungan_id',
        'pendaftaran_id',
        'nomor_gigi',
        'posisi',
        'transform',
        'kondisi',
        'tindakan',
        'tanggal',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function kondisi_gigi()
    {
        return $this->belongsTo(OdontogramGigi::class, 'kondisi');
    }
}

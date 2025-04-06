<?php

namespace App\Models\MedicalRecord;

use App\Models\Master\ICD10;
use App\Models\Pendaftaran\Kunjungan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $connection = 'rekam_medis';

    protected $table = 'diagnosa';

    protected $fillable = [
        'kunjungan_id',
        'diagnosa_id',
        'keterangan',
        'kategori',
        'tanggal',
        'petugas',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }

    public function diagnosa()
    {
        return $this->belongsTo(ICD10::class, 'diagnosa_id');
    }
}

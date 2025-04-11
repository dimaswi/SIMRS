<?php

namespace App\Models\MedicalRecord;

use App\Models\Pendaftaran\Kunjungan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdontogramDetail extends Model
{
    use HasFactory;

    protected $connection = 'rekam_medis';

    protected $table = 'odontogram_detail';

    protected $fillable = [
        'kunjungan_id',
        'occlusi',
        'torus_platinus',
        'torus_mandibularis',
        'palatum',
        'diastema',
        'anomali',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }
}

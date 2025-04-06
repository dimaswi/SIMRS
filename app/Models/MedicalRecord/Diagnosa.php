<?php

namespace App\Models\MedicalRecord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $connection = 'rekam_medis';

    protected $table = 'diagnosa';

    protected $fillable = [
        'kunjungan_id',
        'code',
        'display',
        'keterangan',
        'kategori',
        'tanggal',
        'petugas',
    ];
}

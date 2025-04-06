<?php

namespace App\Models\MedicalRecord;

use App\Models\Aplikasi\TindakanToRuangan;
use App\Models\Pendaftaran\Kunjungan;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'rekam_medis';

    protected $table = 'tindakan';

    protected $fillable = [
        'kunjungan_id',
        'tindakan_id',
        'petugas',
        'tanggal_tindakan',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }

    public function tindakan()
    {
        return $this->belongsTo(TindakanToRuangan::class, 'tindakan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'petugas');
    }
}

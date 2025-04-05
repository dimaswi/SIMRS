<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaPasien extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'keluarga_pasien';

    protected $fillable = [
        'norm',
        'nama_keluarga',
        'hubungan',
        'nomor_telepon',
        'alamat',
    ];

    public function hubunganPasien()
    {
        return $this->belongsTo(HubunganPasien::class, 'hubungan', 'id');
    }
}

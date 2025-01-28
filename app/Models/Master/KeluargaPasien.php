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
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'nomor_telepon',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
    ];
}

<?php

namespace App\Models\Master;

use App\Models\Aplikasi\UserToRuangan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'ruangan';

    protected $fillable = [
        'nama_ruangan',
        'kelas',
        'jenis_kunjungan',
        'rawat_inap',
    ];

    public function kelasRuangan()
    {
        return $this->belongsTo(Kelas::class, 'kelas');
    }

    public function userRuangan()
    {
        return $this->hasMany(UserToRuangan::class, 'id', 'id_ruangan');
    }

    public function jenisKunjungan()
    {
        return $this->belongsTo(JenisKunjungan::class, 'jenis_kunjungan');
    }
}

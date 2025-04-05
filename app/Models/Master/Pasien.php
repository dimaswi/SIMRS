<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'master';

    protected $table = 'pasien';

    protected $fillable = [
        'norm',
        'gelar_depan',
        'gelar_belakang',
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'nama_ibu',
        'pekerjaan',
        'pendidikan',
        'nomor_telepon',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
    ];

    public function keluargaPasien()
    {
        return $this->hasMany(KeluargaPasien::class, 'norm', 'norm');
    }

    public function Kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan');
    }

    public function Kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan');
    }

    public function Kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten');
    }

    public function Provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function kartuIdentitas()
    {
        return $this->hasMany(KartuIdentitasPasien::class, 'norm', 'norm');
    }
}

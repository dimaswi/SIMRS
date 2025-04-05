<?php

namespace App\Models\Pendaftaran;

use App\Models\Master\Pasien;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'pendaftaran';

    protected $table = 'pendaftaran';

    protected $fillable = [
        'norm',
        'pendaftar',
        'baru',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'norm', 'norm');
    }

    public function daf_kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }
}

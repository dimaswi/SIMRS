<?php

namespace App\Models\Pendaftaran;

use App\Models\Master\Ruangan;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'pendaftaran';

    protected $table = 'kunjungan';

    protected $fillable = [
        'pendaftaran_id',
        'ruangan_id',
        'dokter_id',
        'masuk',
        'terima',
        'final',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}

<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuIdentitasPasien extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'kartu_identitas_pasien';

    protected $fillable = [
        'norm',
        'jenis_kartu',
        'nomor_kartu',
    ];

    public function jenisKartu()
    {
        return $this->belongsTo(JenisKartuIdentitas::class, 'jenis_kartu');
    }
}

<?php

namespace App\Models\Aplikasi;

use App\Models\Master\JenisTarif;
use App\Models\Master\Ruangan;
use App\Models\Master\Tarif;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifToRuangan extends Model
{
    use HasFactory;

    protected $connection = 'aplikasi';

    protected $table = 'tarif_to_ruangan';

    protected $fillable = [
        'tarif_id',
        'ruangan_id',
        'jenis_tarif_id'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }

    public function jenis_tarif()
    {
        return $this->belongsTo(JenisTarif::class, 'jenis_tarif_id');
    }
}

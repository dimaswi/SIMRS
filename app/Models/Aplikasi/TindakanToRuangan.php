<?php

namespace App\Models\Aplikasi;

use App\Models\Master\Ruangan;
use App\Models\Master\Tindakan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanToRuangan extends Model
{
    use HasFactory;

    protected $connection = 'aplikasi';

    protected $table = 'tindakan_to_ruangan';

    protected $fillable = [
        'id_tindakan',
        'id_ruangan',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class, 'id_tindakan');
    }
}

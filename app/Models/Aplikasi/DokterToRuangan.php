<?php

namespace App\Models\Aplikasi;

use App\Models\Master\Ruangan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterToRuangan extends Model
{
    use HasFactory;

    protected $connection = 'aplikasi';

    protected $table = 'dokter_to_ruangan';

    protected $fillable = [
        'user_id',
        'ruangan_id',
        'jadwal',
        'jam_buka',
        'jam_tutup',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

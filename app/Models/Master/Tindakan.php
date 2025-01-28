<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'tindakan';

    protected $fillable = [
        'nama_tindakan',
        'tagihan_paramedis',
        'tagihan_dokter',
        'tagihan_sarana',
        'tagihan_farmasi',
        'tagihan_oksigen',
        'oksigen',
        'total_tagihan',
    ];
}

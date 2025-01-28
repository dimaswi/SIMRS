<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKunjungan extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'jenis_kunjungan';

    protected $fillable = [
        'nama_kunjungan'
    ];
}

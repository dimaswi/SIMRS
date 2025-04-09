<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTarif extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'jenis_tarif';

    protected $fillable = [
        'nama_tarif'
    ];
}

<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'pendidikan';

    protected $fillable = [
        'nama_pendidikan',
    ];
}

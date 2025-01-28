<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'agama';

    protected $fillable = [
        'nama_agama',
    ];
}

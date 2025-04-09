<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdontogramGigi extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'odontogram_gigi';

    protected $fillable = [
        'simbol',
        'keterangan',
    ];
}

<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'tarif';

    protected $fillable = [
        'nama_tarif',
        'tarif',
    ];
}

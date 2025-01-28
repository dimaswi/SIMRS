<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'pekerjaan';

    protected $fillable = [
        'nama_pekerjaan',
    ];
}

<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'jenis_kelamin';

    protected $fillable = [
        'nama_jenis_kelamin',
    ];
}

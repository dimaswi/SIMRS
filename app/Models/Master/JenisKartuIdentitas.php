<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKartuIdentitas extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'jenis_kartu_identitas';

    protected $fillable = [
        'nama_kartu',
    ];
}

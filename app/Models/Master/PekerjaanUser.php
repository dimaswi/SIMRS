<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanUser extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'pekerjaan_user';

    protected $fillable = [
        'nama_pekerjaan'
    ];
}

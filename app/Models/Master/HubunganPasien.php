<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HubunganPasien extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'hubungan_pasien';

    protected $fillable = ['nama_hubungan'];
}

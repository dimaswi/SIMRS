<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICD10 extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'ICD10';

    protected $fillable = [
        'code',
        'display',
        'version',
    ];
}

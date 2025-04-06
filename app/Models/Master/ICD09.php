<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICD09 extends Model
{
    use HasFactory;

    protected $connection = 'master';

    protected $table = 'ICD09';

    protected $fillable = [
        'code',
        'display',
        'version',
    ];
}

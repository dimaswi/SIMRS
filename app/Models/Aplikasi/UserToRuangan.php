<?php

namespace App\Models\Aplikasi;

use App\Models\Master\Ruangan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToRuangan extends Model
{
    use HasFactory;

    protected $connection = 'aplikasi';

    protected $table = 'user_to_ruangan';

    protected $fillable = [
        'id_user',
        'id_ruangan',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

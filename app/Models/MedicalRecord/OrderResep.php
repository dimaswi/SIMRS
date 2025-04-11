<?php

namespace App\Models\MedicalRecord;

use App\Models\Aplikasi\BarangToRuangan;
use App\Models\Pendaftaran\Kunjungan;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderResep extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'rekam_medis';

    protected $table = 'order_resep';

    protected $fillable = [
        'id',
        'kunjungan_id',
        'pemberi_resep',
        'dokter_dpjp',
        'alergi_obat',
        'obat_id',
        'diagnosa',
        'gangguan_fungsi_ginjal'
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id', 'id');
    }

    public function obat()
    {
        return $this->belongsTo(BarangToRuangan::class, 'obat_id', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'pemberi_resep');
    }

    public function dokterDpjp()
    {
        return $this->belongsTo(User::class, 'dokter_dpjp');
    }

    public function orderResepDetil()
    {
        return $this->hasMany(OrderResepDetil::class, 'order_resep_id');
    }
}

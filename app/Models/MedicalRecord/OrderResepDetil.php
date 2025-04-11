<?php

namespace App\Models\MedicalRecord;

use App\Models\Aplikasi\BarangToRuangan;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderResepDetil extends Model
{
    use HasFactory, HasUuids;

    protected $connection = 'rekam_medis';

    protected $table = 'order_resep_detil';

    protected $fillable = [
        'id',
        'order_resep_id',
        'kunjungan_id',
        'obat_id',
        'aturan_pakai',
        'dosis',
        'frekuensi',
        'rute_pemberian',
        'jumlah',
        'harga'
    ];

    public function orderResep()
    {
        return $this->belongsTo(OrderResep::class, 'order_resep_id');
    }

    public function obat()
    {
        return $this->belongsTo(BarangToRuangan::class, 'obat_id');
    }
}

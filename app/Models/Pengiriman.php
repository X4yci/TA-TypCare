<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'pesanan_id',
        'nama_kurir',
        'layanan_kurir',
        'nomor_resi',
        'alamat_tujuan',
        'ongkos_kirim',
        'estimasi_tiba',
        'status_pengiriman', // 'menunggu_pickup', 'dalam_perjalanan', 'terkirim'
    ];

    protected function casts(): array
    {
        return [
            'ongkos_kirim' => 'integer',
        ];
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pesanan_id',
        'kode_referensi_gateway',
        'metode_pembayaran', // 'QRIS', 'Virtual Account', 'E-Wallet'
        'nominal_bayar',
        'status_pembayaran', // 'pending', 'lunas', 'gagal'
        'waktu_verifikasi',
    ];

    protected function casts(): array
    {
        return [
            'nominal_bayar' => 'integer',
            'waktu_verifikasi' => 'datetime',
        ];
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}

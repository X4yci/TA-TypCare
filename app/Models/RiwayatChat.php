<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatChat extends Model
{
    use HasFactory;

    protected $table = 'riwayat_chat';

    protected $fillable = [
        'user_id',
        'keluhan_pengguna',
        'jawaban_ai',
        'produk_rekomendasi_id',
        'menggunakan_fallback',
    ];

    protected function casts(): array
    {
        return [
            'menggunakan_fallback' => 'boolean',
        ];
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produkRekomendasi(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_rekomendasi_id');
    }
}

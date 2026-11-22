<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kode_varian',
        'nama_produk',
        'kategori_manfaat',
        'ukuran_ml',
        'harga',
        'komposisi',
        'deskripsi',
        'gambar',
        'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'integer',
            'ukuran_ml' => 'integer',
            'status_aktif' => 'boolean',
        ];
    }

    /**
     * Relasi ke seluruh batch produksi untuk varian jamu ini.
     */
    public function batchProduksi(): HasMany
    {
        return $this->hasMany(BatchProduksi::class, 'produk_id');
    }

    /**
     * Hitung total stok botol yang layak jual (lolos filter kedaluwarsa H-3).
     */
    public function hitungStokLayakJual(): int
    {
        return (int) BatchProduksi::filterH3()
            ->where('produk_id', $this->id)
            ->sum('stok_tersedia');
    }
}

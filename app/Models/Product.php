<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nama_barang',
        'ukuran',
        'harga',
        'stok',
        'kode_batch',
        'tgl_kedaluwarsa',
        'deskripsi',
        'komposisi',
        'manfaat_kesehatan',
        'kandungan_alergen',
        'foto',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'integer',
            'stok' => 'integer',
            'tgl_kedaluwarsa' => 'date',
        ];
    }

    /**
     * Scope Auto-Filter H-3 & pengurutan FEFO (First Expired, First Out).
     */
    public function scopeLayakJualFEFO(Builder $query, ?Carbon $acuan = null): Builder
    {
        $batasH3 = ($acuan ?? Carbon::today())->copy()->addDays(3)->toDateString();

        return $query
            ->where('stok', '>', 0)
            ->where(function (Builder $q) use ($batasH3) {
                $q->whereNull('tgl_kedaluwarsa')
                    ->orWhereDate('tgl_kedaluwarsa', '>', $batasH3);
            })
            ->orderBy('tgl_kedaluwarsa', 'asc')
            ->orderBy('id', 'asc');
    }

    /**
     * Hitung sisa hari sebelum kedaluwarsa.
     */
    public function sisaHari(?Carbon $acuan = null): int
    {
        if (! $this->tgl_kedaluwarsa) {
            return 14;
        }

        $hariIni = ($acuan ?? Carbon::today())->startOfDay();

        return (int) $hariIni->diffInDays(Carbon::parse($this->tgl_kedaluwarsa)->startOfDay(), false);
    }
}

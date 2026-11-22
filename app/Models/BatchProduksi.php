<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RuntimeException;

class BatchProduksi extends Model
{
    use HasFactory;

    protected $table = 'batch_produksi';

    protected $fillable = [
        'produk_id',
        'kode_batch',
        'tanggal_produksi',
        'tanggal_kedaluwarsa',
        'jumlah_awal',
        'stok_tersedia',
        'status_batch', // 'layak_jual', 'warning_h6', 'terkunci_h3', 'habis'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_produksi' => 'date',
            'tanggal_kedaluwarsa' => 'date',
            'jumlah_awal' => 'integer',
            'stok_tersedia' => 'integer',
        ];
    }

    /**
     * Relasi ke varian produk jamu.
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    /**
     * Hitung sisa hari simpan terhadap tanggal hari ini.
     */
    public function sisaHari(?Carbon $acuan = null): int
    {
        $hariIni = ($acuan ?? Carbon::today())->startOfDay();

        return (int) $hariIni->diffInDays(Carbon::parse($this->tanggal_kedaluwarsa)->startOfDay(), false);
    }

    /**
     * Scope Auto-Filter H-3:
     * Mengunci otomatis batch dengan sisa masa simpan <= 3 hari agar tidak tampil di katalog pembeli,
     * dan mengurutkan berdasarkan kedaluwarsa terdekat (FEFO - First Expired First Out).
     */
    public function scopeFilterH3(Builder $query, ?Carbon $acuan = null): Builder
    {
        $batasKunciH3 = ($acuan ?? Carbon::today())->copy()->addDays(3)->toDateString();

        return $query
            ->where('stok_tersedia', '>', 0)
            ->whereDate('tanggal_kedaluwarsa', '>', $batasKunciH3)
            ->orderBy('tanggal_kedaluwarsa', 'asc')
            ->orderBy('id', 'asc');
    }

    /**
     * Metode statis filterH3() sesuai Class Diagram SKPL.
     */
    public static function filterH3(?Carbon $acuan = null): Builder
    {
        return static::query()->filterH3($acuan);
    }

    /**
     * Algoritma Pemotongan Stok FEFO (First Expired, First Out):
     * Memotong stok dari batch layak jual yang memiliki tanggal kedaluwarsa paling dekat terlebih dahulu.
     *
     * @return array<int, array{batch_id: int, kode_batch: string, jumlah_dipotong: int}>
     */
    public static function potongStokFEFO(int $produkId, int $jumlahPesanan): array
    {
        $antreanBatch = static::filterH3()
            ->where('produk_id', $produkId)
            ->lockForUpdate()
            ->get();

        $totalLayakJual = $antreanBatch->sum('stok_tersedia');

        if ($totalLayakJual < $jumlahPesanan) {
            throw new RuntimeException('Stok layak jual (lolos filter H-3) tidak mencukupi untuk jumlah pesanan.');
        }

        $sisaKebutuhan = $jumlahPesanan;
        $alokasiTerpotong = [];

        foreach ($antreanBatch as $batch) {
            if ($sisaKebutuhan <= 0) {
                break;
            }

            $ambil = min($batch->stok_tersedia, $sisaKebutuhan);
            $batch->stok_tersedia -= $ambil;

            if ($batch->stok_tersedia === 0) {
                $batch->status_batch = 'habis';
            }

            $batch->save();

            $alokasiTerpotong[] = [
                'batch_id' => $batch->id,
                'kode_batch' => $batch->kode_batch,
                'jumlah_dipotong' => $ambil,
            ];

            $sisaKebutuhan -= $ambil;
        }

        return $alokasiTerpotong;
    }
}

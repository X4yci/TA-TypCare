<?php

namespace App\Http\Controllers;

use App\Models\BatchProduksi;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Proses Checkout Pesanan dan Pemotongan Stok Otomatis dengan Algoritma FEFO (First Expired, First Out).
     */
    public function checkout(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'produk_id' => ['required', 'integer'],
            'jumlah_botol' => ['required', 'integer', 'min:1'],
            'harga_satuan' => ['required', 'integer', 'min:0'],
            'catatan' => ['nullable', 'string', 'max:255'],
        ]);

        return DB::transaction(function () use ($validated, $request) {
            // 1. Potong stok dari batch layak jual (lolos filter H-3) dengan urutan kedaluwarsa terdekat (FEFO)
            $alokasiBatch = BatchProduksi::potongStokFEFO(
                (int) $validated['produk_id'],
                (int) $validated['jumlah_botol']
            );

            $totalHarga = (int) $validated['jumlah_botol'] * (int) $validated['harga_satuan'];

            // 2. Buat header transaksi pesanan
            $pesanan = Pesanan::create([
                'nomor_pesanan' => 'ORD-TYP-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4)),
                'user_id' => $request->user()?->id ?? 1,
                'tanggal_pesanan' => now(),
                'total_harga' => $totalHarga,
                'status_pesanan' => 'menunggu_pembayaran',
                'catatan_pembeli' => $validated['catatan'] ?? null,
            ]);

            // 3. Catat detail pesanan per batch yang terpotong
            foreach ($alokasiBatch as $alokasi) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $validated['produk_id'],
                    'batch_produksi_id' => $alokasi['batch_id'],
                    'kode_batch_teralokasi' => $alokasi['kode_batch'],
                    'jumlah_botol' => $alokasi['jumlah_dipotong'],
                    'harga_satuan' => $validated['harga_satuan'],
                    'subtotal' => $alokasi['jumlah_dipotong'] * (int) $validated['harga_satuan'],
                ]);
            }

            return response()->json([
                'message' => 'Pesanan berhasil dibuat dengan alokasi stok FEFO.',
                'nomor_pesanan' => $pesanan->nomor_pesanan,
                'alokasi_fefo' => $alokasiBatch,
            ], 201);
        });
    }
}

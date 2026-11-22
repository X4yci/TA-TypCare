<?php

namespace App\Http\Controllers;

use App\Models\BatchProduksi;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Validasi dan simpan input batch produksi harian baru oleh Admin,
     * serta hitung status kelayakan FEFO dan Auto-Lock H-3 secara otomatis.
     */
    public function storeBatch(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'produk_id' => ['required', 'integer'],
            'kode_batch' => ['required', 'string', 'max:50'],
            'tanggal_produksi' => ['required', 'date'],
            'tanggal_kedaluwarsa' => ['required', 'date', 'after:tanggal_produksi'],
            'jumlah_produksi' => ['required', 'integer', 'min:1'],
        ]);

        $sisaHari = Carbon::today()->diffInDays(Carbon::parse($validated['tanggal_kedaluwarsa']), false);

        $statusBatch = match (true) {
            $sisaHari <= 3 => 'terkunci_h3',
            $sisaHari <= 7 => 'warning_h6',
            default => 'layak_jual',
        };

        $batch = BatchProduksi::create([
            'produk_id' => $validated['produk_id'],
            'kode_batch' => $validated['kode_batch'],
            'tanggal_produksi' => $validated['tanggal_produksi'],
            'tanggal_kedaluwarsa' => $validated['tanggal_kedaluwarsa'],
            'jumlah_awal' => $validated['jumlah_produksi'],
            'stok_tersedia' => $validated['jumlah_produksi'],
            'status_batch' => $statusBatch,
        ]);

        return response()->json([
            'message' => 'Batch produksi baru berhasil disimpan dan diurutkan ke antrean FEFO.',
            'batch' => $batch,
            'sisa_hari' => $sisaHari,
        ], 201);
    }
}

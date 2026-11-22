<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Pesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Pembaruan preview kurir, nomor resi, dan status pengiriman pesanan.
     */
    public function updateKurir(Request $request, int $pesananId): JsonResponse
    {
        $validated = $request->validate([
            'nama_kurir' => ['required', 'string', 'max:60'],
            'layanan_kurir' => ['required', 'string', 'max:60'],
            'nomor_resi' => ['required', 'string', 'max:80'],
            'alamat_tujuan' => ['required', 'string'],
            'estimasi_tiba' => ['nullable', 'string', 'max:60'],
            'status_pengiriman' => ['required', 'string', 'in:menunggu_pickup,dalam_perjalanan,terkirim'],
        ]);

        $pesanan = Pesanan::findOrFail($pesananId);

        $pengiriman = Pengiriman::updateOrCreate(
            ['pesanan_id' => $pesanan->id],
            $validated
        );

        if ($validated['status_pengiriman'] === 'dalam_perjalanan') {
            $pesanan->update(['status_pesanan' => 'dikirim']);
        } elseif ($validated['status_pengiriman'] === 'terkirim') {
            $pesanan->update(['status_pesanan' => 'selesai']);
        }

        return response()->json([
            'message' => 'Preview kurir dan status pelacakan berhasil diperbarui.',
            'pengiriman' => $pengiriman,
        ]);
    }
}

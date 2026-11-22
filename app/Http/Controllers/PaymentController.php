<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Simulasi verifikasi pembayaran Payment Gateway dan pembaruan status pesanan menjadi diproses.
     */
    public function simulasiBayar(Request $request, int $pesananId): JsonResponse
    {
        $validated = $request->validate([
            'metode_pembayaran' => ['required', 'string', 'in:QRIS,Virtual Account,E-Wallet'],
        ]);

        $pesanan = Pesanan::findOrFail($pesananId);

        $pembayaran = Pembayaran::updateOrCreate(
            ['pesanan_id' => $pesanan->id],
            [
                'kode_referensi_gateway' => 'PAY-TYP-' . Str::upper(Str::random(8)),
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'nominal_bayar' => $pesanan->total_harga,
                'status_pembayaran' => 'lunas',
                'waktu_verifikasi' => now(),
            ]
        );

        $pesanan->update([
            'status_pesanan' => 'diproses',
        ]);

        return response()->json([
            'message' => 'Pembayaran terverifikasi lunas oleh Payment Gateway.',
            'pembayaran' => $pembayaran,
        ]);
    }
}

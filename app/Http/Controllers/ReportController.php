<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Rekapitulasi laporan penjualan lunas dan ekspor data laporan.
     */
    public function exportLaporan(Request $request): JsonResponse
    {
        $totalPendapatanLunas = Pembayaran::where('status_pembayaran', 'lunas')
            ->sum('nominal_bayar');

        $jumlahPesananSelesai = Pesanan::whereIn('status_pesanan', ['diproses', 'dikirim', 'selesai'])
            ->count();

        return response()->json([
            'judul_laporan' => 'Laporan Penjualan Operasional TYP-Care',
            'tanggal_cetak' => now()->format('d M Y, H:i') . ' WIB',
            'total_pendapatan_lunas' => (int) $totalPendapatanLunas,
            'jumlah_pesanan_aktif_dan_selesai' => $jumlahPesananSelesai,
        ]);
    }
}

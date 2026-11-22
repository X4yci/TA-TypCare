<?php

namespace App\Http\Controllers;

use App\Models\RiwayatChat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class ChatbotController extends Controller
{
    /**
     * Konsultasi keluhan kesehatan via API AI Chatbot dengan mekanisme Fallback lokal.
     */
    public function konsultasi(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'keluhan' => ['required', 'string', 'max:500'],
        ]);

        $keluhan = trim($validated['keluhan']);
        $pakaiFallback = false;

        try {
            $apiKey = config('services.gemini.api_key');

            if (empty($apiKey)) {
                throw new \RuntimeException('API key belum dikonfigurasi, aktifkan fallback lokal.');
            }

            $response = Http::timeout(8)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => "Anda adalah asisten herbal TYP-Care. Berikan rekomendasi jamu (Kunyit Asam, Beras Kencur, Temulawak, atau Jahe Merah) untuk keluhan: {$keluhan}"],
                            ],
                        ],
                    ],
                ]
            );

            $jawaban = $response->json('candidates.0.content.parts.0.text')
                ?? $this->rekomendasiFallback($keluhan);
        } catch (Throwable) {
            $pakaiFallback = true;
            $jawaban = $this->rekomendasiFallback($keluhan);
        }

        return response()->json([
            'keluhan' => $keluhan,
            'jawaban' => $jawaban,
            'menggunakan_fallback' => $pakaiFallback,
        ]);
    }

    /**
     * Mekanisme Fallback berbasis aturan kata kunci lokal apabila API AI tidak terjangkau.
     */
    private function rekomendasiFallback(string $keluhan): string
    {
        $teks = Str::lower($keluhan);

        if (Str::contains($teks, ['pegal', 'lelah', 'stamina', 'capek'])) {
            return 'Rekomendasi TYP-Care: Beras Kencur Creamy (250 ml) untuk membantu memulihkan stamina dan meredakan pegal linu.';
        }

        if (Str::contains($teks, ['imun', 'lambung', 'pencernaan', 'maag', 'nafsu makan'])) {
            return 'Rekomendasi TYP-Care: Temulawak Honey (500 ml) untuk menjaga imunitas dan mendukung kesehatan fungsi pencernaan.';
        }

        if (Str::contains($teks, ['masuk angin', 'dingin', 'flu', 'batuk', 'hangat'])) {
            return 'Rekomendasi TYP-Care: Red Ginger Shot / Jahe Merah (250 ml) untuk menghangatkan tubuh dan menjaga metabolisme.';
        }

        return 'Rekomendasi TYP-Care: Kunyit Asam Royal (250 ml) kaya antioksidan alami untuk Daily Detox dan kesegaran tubuh harian.';
    }
}

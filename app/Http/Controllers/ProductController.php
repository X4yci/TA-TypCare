<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Simpan atau perbarui data master produk varian jamu oleh Admin.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kode_varian' => ['required', 'string', 'max:10'],
            'nama_produk' => ['required', 'string', 'max:120'],
            'kategori_manfaat' => ['required', 'string', 'max:80'],
            'ukuran_ml' => ['required', 'integer', 'min:50'],
            'harga' => ['required', 'integer', 'min:1000'],
            'komposisi' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $produk = Produk::create(array_merge($validated, [
            'status_aktif' => true,
        ]));

        return response()->json([
            'message' => 'Data master produk jamu berhasil ditambahkan.',
            'produk' => $produk,
        ], 201);
    }
}

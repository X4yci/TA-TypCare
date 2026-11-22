<?php

namespace App\Http\Controllers;

use App\Models\BatchProduksi;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Tampilkan halaman awal (Welcome).
     */
    public function welcome()
    {
        return view('pages.welcome');
    }

    /**
     * Tampilkan halaman kedua (Introduction).
     */
    public function introduction()
    {
        return view('pages.introduction');
    }

    /**
     * Tampilkan halaman Beranda Utama (Home).
     */
    public function beranda()
    {
        return view('pages.beranda');
    }

    /**
     * Tampilkan katalog produk dengan penyaringan Auto-Filter H-3
     * (Hanya menampilkan produk dari batch dengan masa simpan > 3 hari).
     */
    public function index(Request $request)
    {
        return view('pages.products');
    }
}

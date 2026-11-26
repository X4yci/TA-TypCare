<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Akun Admin Default
        Admin::updateOrCreate(
            ['email' => 'admin@typ-herbal.id'],
            [
                'nama' => 'Rinaldi Mulya Putra',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Seed Akun Pelanggan Default
        Customer::updateOrCreate(
            ['email' => 'pelanggan@gmail.com'],
            [
                'nama' => 'Theresa Nathalie',
                'password' => Hash::make('user123'),
                'no_whatsapp' => '081234567890',
                'alamat' => 'Jl. Semarang No. 5, Lowokwaru, Kota Malang',
            ]
        );

        // 3. Seed 4 Data Barang Jamu Botolan TYP HERBAL DRINK
        $products = [
            [
                'nama_barang' => 'Jamu Kunyit Asam Segar 250ml',
                'ukuran' => '250 ml',
                'harga' => 15000,
                'stok' => 10,
                'kode_batch' => 'BATCH-KA-20261112-02',
                'tgl_kedaluwarsa' => '2026-11-23',
                'deskripsi' => 'Minuman herbal segar dari perasan rimpang kunyit pilihan dan asam jawa murni dengan pemanis gula aren organik untuk detoks harian.',
                'komposisi' => 'Rimpang Kunyit Segar, Asam Jawa Murni, Gula Aren Organik, Air Mineral.',
                'manfaat_kesehatan' => 'Daily Detox & Antioksidan, membantu melancarkan metabolisme, meredakan nyeri haid, dan menyegarkan tubuh.',
                'kandungan_alergen' => 'Tidak mengandung alergen umum. Bagi penderita maag/GERD akut disarankan konsumsi setelah makan.',
                'foto' => '2.jpeg',
            ],
            [
                'nama_barang' => 'Jamu Beras Kencur Original 250ml',
                'ukuran' => '250 ml',
                'harga' => 16000,
                'stok' => 8,
                'kode_batch' => 'BATCH-BK-20261111-01',
                'tgl_kedaluwarsa' => '2026-11-18',
                'deskripsi' => 'Racikan tradisional dengan tekstur lembut dari beras organik sangrai dan ekstrak rimpang kencur segar untuk pemulihan tenaga.',
                'komposisi' => 'Beras Putih Organik, Rimpang Kencur Segar, Jahe Emprit, Gula Kelapa, Air Mineral.',
                'manfaat_kesehatan' => 'Stamina & Pegal Linu, membantu meredakan kelelahan otot, menghangatkan badan, dan menambah nafsu makan.',
                'kandungan_alergen' => 'Mengandung sari beras dan gula alami; perhatikan batas konsumsi harian bagi penderita diabetes.',
                'foto' => '3.jpeg',
            ],
            [
                'nama_barang' => 'Jamu Temulawak Kurma Madu 500ml',
                'ukuran' => '500 ml',
                'harga' => 25000,
                'stok' => 12,
                'kode_batch' => 'BATCH-TW-20261112-01',
                'tgl_kedaluwarsa' => '2026-11-25',
                'deskripsi' => 'Kombinasi rimpang temulawak Nusantara dengan ekstrak kurma dan madu hutan murni untuk menjaga daya tahan tubuh dan fungsi pencernaan.',
                'komposisi' => 'Rimpang Temulawak Segar, Sari Kurma, Madu Hutan Murni, Rimpang Kunyit, Air Mineral.',
                'manfaat_kesehatan' => 'Imunitas & Pencernaan, mendukung kesehatan fungsi hati (liver), meningkatkan imun tubuh, dan menenangkan lambung.',
                'kandungan_alergen' => 'Mengandung madu alami (pantangan bagi bayi di bawah usia 1 tahun dan penderita alergi produk lebah).',
                'foto' => '1.jpeg',
            ],
            [
                'nama_barang' => 'Jamu Jahe Merah Hangat 250ml',
                'ukuran' => '250 ml',
                'harga' => 18000,
                'stok' => 16,
                'kode_batch' => 'BATCH-JM-20261112-01',
                'tgl_kedaluwarsa' => '2026-11-26',
                'deskripsi' => 'Perasan rimpang jahe merah pilihan yang dipadukan dengan serai dan rempah aromatik untuk memberikan kehangatan alami tubuh.',
                'komposisi' => 'Rimpang Jahe Merah Segar, Serai Wangi, Kayu Manis, Gula Aren, Air Mineral.',
                'manfaat_kesehatan' => 'Hangat Tubuh & Metabolisme, meredakan gejala masuk angin, melegakan tenggorokan, dan melancarkan sirkulasi darah.',
                'kandungan_alergen' => 'Sensasi pedas hangat gingerol tinggi; hindari konsumsi berlebihan saat perut kosong pada penderita tukak lambung.',
                'foto' => '4.jpeg',
            ],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(
                ['nama_barang' => $item['nama_barang']],
                $item
            );
        }
    }
}

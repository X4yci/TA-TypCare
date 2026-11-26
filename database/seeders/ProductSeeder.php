<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // 4 Produk Awal yang Dipertahankan
            [
                'nama_barang' => 'Jamu Kunyit Asam Segar 250ml',
                'ukuran' => '250 ml',
                'harga' => 15000,
                'stok' => 10,
                'kode_batch' => 'BATCH-KA-20261112-02',
                'tgl_kedaluwarsa' => '2026-12-03',
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
                'tgl_kedaluwarsa' => '2026-12-01',
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
                'tgl_kedaluwarsa' => '2026-12-05',
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
                'tgl_kedaluwarsa' => '2026-12-06',
                'deskripsi' => 'Perasan rimpang jahe merah pilihan yang dipadukan dengan serai dan rempah aromatik untuk memberikan kehangatan alami tubuh.',
                'komposisi' => 'Rimpang Jahe Merah Segar, Serai Wangi, Kayu Manis, Gula Aren, Air Mineral.',
                'manfaat_kesehatan' => 'Hangat Tubuh & Metabolisme, meredakan gejala masuk angin, melegakan tenggorokan, dan melancarkan sirkulasi darah.',
                'kandungan_alergen' => 'Sensasi pedas hangat gingerol tinggi; hindari konsumsi berlebihan saat perut kosong pada penderita tukak lambung.',
                'foto' => '4.jpeg',
            ],

            // 8 Produk Tambahan Sesuai Tema Aplikasi TYP-Care (Total 12 Produk)
            [
                'nama_barang' => 'Jeruk Nipis Gula Batu 250ml',
                'ukuran' => '250 ml',
                'harga' => 15000,
                'stok' => 14,
                'kode_batch' => 'BATCH-JN-20261114-01',
                'tgl_kedaluwarsa' => '2026-12-07',
                'deskripsi' => 'Minuman botanikal segar dari perasan jeruk nipis lokal pilihan dengan manis alami gula batu kristal untuk melegakan tenggorokan.',
                'komposisi' => 'Sari Jeruk Nipis Segar, Gula Batu Kristal, Sedikit Garam Himalaya, Air Mineral.',
                'manfaat_kesehatan' => 'Immunity Boots & Vitamin C alami, membantu melegakan tenggorokan, menyegarkan pernapasan, dan hidrasi harian.',
                'kandungan_alergen' => 'Tingkat keasaman sitrus alami; disarankan dikonsumsi setelah makan bagi pemilik lambung sensitif.',
                'foto' => '4.jpeg',
            ],
            [
                'nama_barang' => 'Kunyit Asam Sirih Pinang Manjakani 250ml',
                'ukuran' => '250 ml',
                'harga' => 20000,
                'stok' => 10,
                'kode_batch' => 'BATCH-KP-20261114-01',
                'tgl_kedaluwarsa' => '2026-12-04',
                'deskripsi' => 'Racikan khusus perawatan kewanitaan dan vitalitas dari kunyit asam, daun sirih hijau, pinang muda, dan ekstrak manjakani.',
                'komposisi' => 'Rimpang Kunyit, Asam Jawa, Daun Sirih Hijau, Pinang Muda, Manjakani, Gula Aren, Air Mineral.',
                'manfaat_kesehatan' => 'Stamina & Perawatan Alami, menjaga kebugaran tubuh wanita, mengurangi bau badan, dan membantu siklus bulanan lebih nyaman.',
                'kandungan_alergen' => 'Tidak disarankan untuk ibu hamil karena mengandung ekstrak pinang muda dan manjakani.',
                'foto' => '5.jpeg',
            ],
            [
                'nama_barang' => 'Kunyit Asam Sirih Royal 250ml',
                'ukuran' => '250 ml',
                'harga' => 18000,
                'stok' => 15,
                'kode_batch' => 'BATCH-KS-20261115-01',
                'tgl_kedaluwarsa' => '2026-12-08',
                'deskripsi' => 'Perpaduan klasik kunyit asam dengan rebusan daun sirih segar sebagai antiseptik dan antioksidan alami harian.',
                'komposisi' => 'Rimpang Kunyit Emas, Daun Sirih Segar, Asam Jawa, Gula kelapa, Air Mineral.',
                'manfaat_kesehatan' => 'Daily Detox & Antioksidan, membantu menjaga kebersihan alami tubuh dari dalam dan menyegarkan stamina.',
                'kandungan_alergen' => 'Bebas bahan pengawet dan pewarna buatan.',
                'foto' => '6.jpeg',
            ],
            [
                'nama_barang' => 'Kunyit Asam Royal 500ml',
                'ukuran' => '500 ml',
                'harga' => 26000,
                'stok' => 9,
                'kode_batch' => 'BATCH-KA-20261115-03',
                'tgl_kedaluwarsa' => '2026-12-09',
                'deskripsi' => 'Kemasan keluarga 500 ml dari varian favorit Kunyit Asam Royal yang diperas dingin tanpa pengawet.',
                'komposisi' => 'Rimpang Kunyit Segar, Asam Jawa Murni, Gula Aren Organik, Kayu Manis, Air Mineral.',
                'manfaat_kesehatan' => 'Daily Detox & Antioksidan, mendukung pemulihan tubuh dan menjaga kesegaran metabolisme sepanjang hari.',
                'kandungan_alergen' => 'Simpan pada suhu dingin 4 derajat Celcius; kocok dahulu sebelum diminum.',
                'foto' => '2.jpeg',
            ],
            [
                'nama_barang' => 'Beras Kencur Creamy 500ml',
                'ukuran' => '500 ml',
                'harga' => 28000,
                'stok' => 11,
                'kode_batch' => 'BATCH-BK-20261115-02',
                'tgl_kedaluwarsa' => '2026-12-06',
                'deskripsi' => 'Varian ukuran 500 ml Beras Kencur Creamy dengan aroma kencur yang kuat dan rasa manis legit yang menenangkan.',
                'komposisi' => 'Beras Organik Sangrai, Kencur Pilihan, Jahe, Kapulaga, Gula Jawa, Air Mineral.',
                'manfaat_kesehatan' => 'Stamina & Pegal Linu, cocok dikonsumsi setelah olahraga atau aktivitas padat untuk merelaksasi otot.',
                'kandungan_alergen' => 'Mengandung endapan beras alami yang kaya serat; kocok perlahan sebelum disajikan.',
                'foto' => '3.jpeg',
            ],
            [
                'nama_barang' => 'Temulawak Honey Booster 250ml',
                'ukuran' => '250 ml',
                'harga' => 17000,
                'stok' => 13,
                'kode_batch' => 'BATCH-TW-20261116-02',
                'tgl_kedaluwarsa' => '2026-12-10',
                'deskripsi' => 'Takaran praktis 250 ml ekstrak temulawak murni dengan madu hutan untuk menjaga fungsi pencernaan dan imunitas harian.',
                'komposisi' => 'Rimpang Temulawak, Madu Hutan Murni, Kunyit, Air Mineral.',
                'manfaat_kesehatan' => 'Immunity Boots & Pencernaan, membantu mengurangi perut kembung dan memelihara daya tahan tubuh.',
                'kandungan_alergen' => 'Mengandung madu murni; tidak diperuntukkan bagi bayi di bawah 12 bulan.',
                'foto' => '1.jpeg',
            ],
            [
                'nama_barang' => 'Red Ginger Shot Emprit 250ml',
                'ukuran' => '250 ml',
                'harga' => 19000,
                'stok' => 12,
                'kode_batch' => 'BATCH-JM-20261116-02',
                'tgl_kedaluwarsa' => '2026-12-11',
                'deskripsi' => 'Kombinasi intens jahe merah dan jahe emprit lokal dengan sentuhan lada hitam dan gula aren untuk penghangat tubuh ekstra.',
                'komposisi' => 'Jahe Merah, Jahe Emprit, Serai, Kayu Manis, Gula Aren, Air Mineral.',
                'manfaat_kesehatan' => 'Hangat Tubuh & Metabolisme, membantu meredakan hidung tersumbat, kelelahan karena cuaca dingin, dan pegal-pegal.',
                'kandungan_alergen' => 'Ekstrak jahe konsentrasi tinggi; disarankan diminum bertahap setelah makan.',
                'foto' => '4.jpeg',
            ],
            [
                'nama_barang' => 'Paket Segar Imunitas & Detoks Alami 500ml',
                'ukuran' => '500 ml',
                'harga' => 32000,
                'stok' => 10,
                'kode_batch' => 'BATCH-PK-20261116-01',
                'tgl_kedaluwarsa' => '2026-12-12',
                'deskripsi' => 'Racikan spesial perpaduan rimpang kunyit, temulawak, dan jahe merah pilihan untuk perlindungan imunitas sekaligus detoks alami.',
                'komposisi' => 'Rimpang Kunyit, Temulawak, Jahe Merah, Asam Jawa, Madu Murni, Air Mineral.',
                'manfaat_kesehatan' => 'Daily Detox & Immunity Boots, kombinasi lengkap untuk menjaga energi dan ketahanan tubuh sepanjang minggu.',
                'kandungan_alergen' => 'Mengandung madu alami dan rempah rimpang aktif.',
                'foto' => '1.jpeg',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['nama_barang' => $product['nama_barang']],
                $product
            );
        }
    }
}

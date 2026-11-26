<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rawPassword = env('SEED_CUSTOMER_PASSWORD', env('SEED_ADMIN_PASSWORD'));

        if (empty($rawPassword)) {
            throw new RuntimeException(
                'Variabel SEED_CUSTOMER_PASSWORD atau SEED_ADMIN_PASSWORD belum diatur di file .env.'
            );
        }

        $hashedPassword = Hash::make($rawPassword);

        $customers = [
            [
                'nama' => 'Theresa Nathalie',
                'email' => 'pelanggan@gmail.com',
                'no_whatsapp' => '081234567890',
                'alamat' => 'Jl. Semarang No. 5, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145',
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'no_whatsapp' => '081331458920',
                'alamat' => 'Jl. Soekarno Hatta Indah Blok C-12, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142',
            ],
            [
                'nama' => 'Siti Nurhaliza Putri',
                'email' => 'siti.nurhaliza@gmail.com',
                'no_whatsapp' => '082143679011',
                'alamat' => 'Jl. Raya Darmo Permai III No. 24, Kec. Dukuhpakis, Kota Surabaya, Jawa Timur 60226',
            ],
            [
                'nama' => 'Andi Pratama Wijaya',
                'email' => 'andi.pratama@gmail.com',
                'no_whatsapp' => '085729841103',
                'alamat' => 'Jl. Kaliurang Km 5.5 Gang Pandega Mandala No. 18, Kec. Depok, Kab. Sleman, DI Yogyakarta 55281',
            ],
            [
                'nama' => 'Dewi Lestari Kusuma',
                'email' => 'dewi.lestari@gmail.com',
                'no_whatsapp' => '081288743219',
                'alamat' => 'Jl. Ir. H. Juanda (Dago) No. 114, Kec. Coblong, Kota Bandung, Jawa Barat 40132',
            ],
            [
                'nama' => 'Rizky Ramadhan Saputra',
                'email' => 'rizky.ramadhan@gmail.com',
                'no_whatsapp' => '081392045671',
                'alamat' => 'Jl. Kemang Raya No. 42, Kec. Mampang Prapatan, Kota Jakarta Selatan, DKI Jakarta 12730',
            ],
            [
                'nama' => 'Nadia Maharani',
                'email' => 'nadia.maharani@gmail.com',
                'no_whatsapp' => '082234190876',
                'alamat' => 'Jl. Pandanaran No. 58, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50134',
            ],
            [
                'nama' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@gmail.com',
                'no_whatsapp' => '085648120934',
                'alamat' => 'Jl. Slamet Riyadi No. 210, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57141',
            ],
            [
                'nama' => 'Ni Putu Ayu Wulandari',
                'email' => 'ayu.wulandari@gmail.com',
                'no_whatsapp' => '081936451208',
                'alamat' => 'Jl. Teuku Umar Barat No. 88, Kec. Denpasar Barat, Kota Denpasar, Bali 80119',
            ],
            [
                'nama' => 'Hendra Gunawan',
                'email' => 'hendra.gunawan@gmail.com',
                'no_whatsapp' => '081219483756',
                'alamat' => 'Jl. Pajajaran Indah V No. 15, Kec. Bogor Timur, Kota Bogor, Jawa Barat 16143',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['email' => $customer['email']],
                [
                    'nama' => $customer['nama'],
                    'password' => $hashedPassword,
                    'no_whatsapp' => $customer['no_whatsapp'],
                    'alamat' => $customer['alamat'],
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = env('SEED_ADMIN_PASSWORD');

        if (empty($password)) {
            throw new RuntimeException(
                'Variabel SEED_ADMIN_PASSWORD belum diatur di file .env. Tambahkan SEED_ADMIN_PASSWORD terlebih dahulu sebelum menjalankan seeder.'
            );
        }

        Admin::updateOrCreate(
            ['email' => 'admin@typ-herbal.id'],
            [
                'nama' => 'Rinaldi Mulya Putra',
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}

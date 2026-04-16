<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('user')->insert([
            [
                'nama' => 'Admin Sistem',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rendy Tri Putra',
                'username' => 'rendy',
                'password' => bcrypt('123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('kategori')->insert([
            ['nama' => 'Akademik', 'deskripsi' => 'Layanan akademik'],
            ['nama' => 'Keuangan', 'deskripsi' => 'Layanan pembayaran'],
            ['nama' => 'Kemahasiswaan', 'deskripsi' => 'Layanan mahasiswa'],
        ]);


        DB::table('layanan')->insert([
            [
                'id_kategori' => 1,
                'nama' => 'KRS Online',
                'deskripsi' => 'Pengisian KRS',
                'url' => 'https://krs.polibatam.ac.id',
                'is_active' => true
            ],
            [
                'id_kategori' => 2,
                'nama' => 'Pembayaran UKT',
                'deskripsi' => 'Bayar kuliah',
                'url' => 'https://ukt.polibatam.ac.id',
                'is_active' => true
            ],
        ]);
    }
}

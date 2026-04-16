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
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rendy Tri Putra',
                'username' => 'rendy',
                'password' => bcrypt('123'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('divisi')->insert([
            ['nama' => 'Akademik', 'deskripsi' => 'Layanan akademik'],
            ['nama' => 'Keuangan', 'deskripsi' => 'Layanan pembayaran'],
            ['nama' => 'Kemahasiswaan', 'deskripsi' => 'Layanan mahasiswa'],
        ]);


        DB::table('layanan')->insert([
            [
                'id_divisi' => 1,
                'nama' => 'KRS Online',
                'deskripsi' => 'Pengisian KRS',
                'url' => 'https://krs.polibatam.ac.id',
                'is_active' => true
            ],
            [
                'id_divisi' => 2,
                'nama' => 'Pembayaran UKT',
                'deskripsi' => 'Bayar kuliah',
                'url' => 'https://ukt.polibatam.ac.id',
                'is_active' => true
            ],
        ]);
    }
}

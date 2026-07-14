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
        DB::table('users')->insert([
            [
                'username'   => 'admin',
                'password'   => bcrypt('123456'),
                'role'       => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'user',
                'password'   => bcrypt('123456'),
                'role'       => 'Mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('kategori')->insert([
            ['id' => 1, 'nama' => 'Akademik',           'deskripsi' => 'Pusat Layanan Akademik',      'created_at' => null, 'updated_at' => null],
            ['id' => 3, 'nama' => 'penelitian',          'deskripsi' => 'umum',                        'created_at' => '2026-06-11 00:00:01', 'updated_at' => '2026-06-11 00:00:01'],
            ['id' => 4, 'nama' => 'Fasilitas Digital',   'deskripsi' => 'Fasilitas Polibatam',         'created_at' => '2026-06-21 22:27:33', 'updated_at' => '2026-07-12 14:55:31'],
            ['id' => 5, 'nama' => 'Urusan Kepegawaian',  'deskripsi' => 'Kepegawaian',                 'created_at' => '2026-07-12 02:21:53', 'updated_at' => '2026-07-12 02:21:53'],
            ['id' => 6, 'nama' => 'Komunikasi',          'deskripsi' => 'Komunikasi Polibatam',        'created_at' => '2026-07-12 02:26:20', 'updated_at' => '2026-07-12 14:55:14'],
        ]);

        DB::table('layanan')->insert([
            ['id' => 2,  'id_kategori' => 1, 'nama' => 'Siakad',                    'deskripsi' => 'Administrasi akademik mahasiswa',          'url' => 'https://siakad.polibatam.ac.id',                                  'is_active' => 2, 'created_at' => null,                  'updated_at' => '2026-07-12 14:36:04'],
            ['id' => 3,  'id_kategori' => 1, 'nama' => 'learning',                  'deskripsi' => 'Platform pembelajaran online',              'url' => 'https://learning-if.polibatam.ac.id/',                            'is_active' => 1, 'created_at' => '2026-06-09 22:47:25', 'updated_at' => '2026-07-12 14:36:16'],
            ['id' => 4,  'id_kategori' => 1, 'nama' => 'koperasi',                  'deskripsi' => 'Layanan koperasi kampus',                   'url' => 'https://koperasi.polibatam.ac.id/',                               'is_active' => 2, 'created_at' => '2026-06-17 23:53:14', 'updated_at' => '2026-07-12 14:36:25'],
            ['id' => 5,  'id_kategori' => 1, 'nama' => 'Siap.PBL',                  'deskripsi' => 'Pengelolaan Project Based Learning',        'url' => 'https://pbl.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-06-21 22:19:12', 'updated_at' => '2026-07-12 14:36:35'],
            ['id' => 6,  'id_kategori' => 1, 'nama' => 'Simbakti',                  'deskripsi' => 'tugas akhir',                               'url' => 'https://simbakti.polibatam.ac.id/',                               'is_active' => 0, 'created_at' => '2026-06-21 22:21:16', 'updated_at' => '2026-07-02 07:05:13'],
            ['id' => 7,  'id_kategori' => 1, 'nama' => 'Sistem Informasi Akademik', 'deskripsi' => 'Informasi akademik mahasiswa',              'url' => 'https://sia.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-06-21 22:25:01', 'updated_at' => '2026-07-12 14:37:10'],
            ['id' => 8,  'id_kategori' => 1, 'nama' => 'SILAM',                     'deskripsi' => 'Layanan administrasi akadamik mahasiswa',   'url' => 'https://sim.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-06-21 22:26:01', 'updated_at' => '2026-07-12 14:38:35'],
            ['id' => 9,  'id_kategori' => 4, 'nama' => 'Portal Sistem Layanan Polibatam', 'deskripsi' => 'sistem internal kampus Polibatam',   'url' => 'https://layanan.polibatam.ac.id/',                                'is_active' => 0, 'created_at' => '2026-06-21 22:28:56', 'updated_at' => '2026-07-02 07:05:13'],
            ['id' => 10, 'id_kategori' => 1, 'nama' => 'Simperpus',                 'deskripsi' => 'Layanan pencarian katalog buku',            'url' => 'https://simperpus.polibatam.ac.id/',                              'is_active' => 0, 'created_at' => '2026-06-21 22:30:23', 'updated_at' => '2026-07-02 07:05:13'],
            ['id' => 11, 'id_kategori' => 1, 'nama' => 'Perpustakaan Digital',      'deskripsi' => 'Perpustakaan digital dan e-book',           'url' => 'https://lib.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-06-21 23:37:50', 'updated_at' => '2026-06-21 23:37:50'],
            ['id' => 13, 'id_kategori' => 5, 'nama' => 'Presensi Online',           'deskripsi' => 'Sistem absensi dan presensi',               'url' => 'https://presensi.polibatam.ac.id',                                'is_active' => 1, 'created_at' => '2026-07-12 02:23:23', 'updated_at' => '2026-07-12 02:23:44'],
            ['id' => 14, 'id_kategori' => 4, 'nama' => 'Peminjaman Polibatam',      'deskripsi' => 'Peminjaman Barang dan Ruangan',             'url' => 'https://peminjaman.polibatam.ac.id/login',                        'is_active' => 1, 'created_at' => '2026-07-12 02:35:23', 'updated_at' => '2026-07-12 02:35:23'],
            ['id' => 15, 'id_kategori' => 4, 'nama' => 'Website Polibatam',         'deskripsi' => 'Website informasi resmi polibatam',         'url' => 'https://www.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-07-12 08:27:25', 'updated_at' => '2026-07-12 14:45:58'],
            ['id' => 16, 'id_kategori' => 6, 'nama' => 'Repository',                'deskripsi' => 'Repository penelitian dan tugas akhir',     'url' => 'https://repository.polibatam.ac.id/home',                         'is_active' => 1, 'created_at' => '2026-07-12 08:36:03', 'updated_at' => '2026-07-12 13:41:40'],
            ['id' => 17, 'id_kategori' => 6, 'nama' => 'Helpdesk',                  'deskripsi' => 'Layanan bantuan teknis',                    'url' => 'https://helpdesk.polibatam.ac.id/',                               'is_active' => 1, 'created_at' => '2026-07-12 08:36:48', 'updated_at' => '2026-07-12 14:43:22'],
            ['id' => 18, 'id_kategori' => 1, 'nama' => 'Jurnal',                    'deskripsi' => 'Publikasi jurnal ilmiah',                   'url' => 'https://jurnal.polibatam.ac.id/',                                 'is_active' => 2, 'created_at' => '2026-07-12 08:38:41', 'updated_at' => '2026-07-12 14:42:17'],
            ['id' => 19, 'id_kategori' => 6, 'nama' => 'P3M',                       'deskripsi' => 'Informasi penelitian kampus',               'url' => 'https://p2m.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-07-12 08:39:29', 'updated_at' => '2026-07-12 14:41:44'],
            ['id' => 20, 'id_kategori' => 6, 'nama' => 'SIMP3M',                    'deskripsi' => 'Pengelolaan penelitian dan PkM',            'url' => 'https://simp3m.polibatam.ac.id/',                                 'is_active' => 1, 'created_at' => '2026-07-12 08:41:33', 'updated_at' => '2026-07-12 14:41:04'],
            ['id' => 21, 'id_kategori' => 6, 'nama' => 'SID',                       'deskripsi' => 'Informasi layanan digital',                 'url' => 'https://sid.polibatam.ac.id/',                                    'is_active' => 0, 'created_at' => '2026-07-12 08:43:19', 'updated_at' => '2026-07-12 14:40:37'],
            ['id' => 22, 'id_kategori' => 6, 'nama' => 'P4M',                       'deskripsi' => 'Informasi pengabdian masyarakat',           'url' => 'https://p4m.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-07-12 08:44:40', 'updated_at' => '2026-07-12 14:40:17'],
            ['id' => 24, 'id_kategori' => 1, 'nama' => 'SIAP',                      'deskripsi' => 'Administrasi proses akademik',              'url' => 'https://siap.polibatam.ac.id/',                                   'is_active' => 2, 'created_at' => '2026-07-12 08:46:55', 'updated_at' => '2026-07-12 14:39:30'],
            ['id' => 25, 'id_kategori' => 1, 'nama' => 'SILAKIN',                   'deskripsi' => 'Administrasi kemahasiswaan',                'url' => 'https://silakin.polibatam.ac.id/',                                'is_active' => 2, 'created_at' => '2026-07-12 08:47:37', 'updated_at' => '2026-07-12 14:51:32'],
            ['id' => 26, 'id_kategori' => 5, 'nama' => 'Registrasi',                'deskripsi' => 'Registrasi layanan kampus',                 'url' => 'https://registrasi.polibatam.ac.id/',                             'is_active' => 1, 'created_at' => '2026-07-12 08:52:28', 'updated_at' => '2026-07-12 14:51:08'],
            ['id' => 27, 'id_kategori' => 4, 'nama' => 'SHILAU',                    'deskripsi' => 'Layanan administrasi digital',              'url' => 'https://shilau.polibatam.ac.id/',                                 'is_active' => 1, 'created_at' => '2026-07-12 09:14:17', 'updated_at' => '2026-07-12 14:50:49'],
            ['id' => 28, 'id_kategori' => 1, 'nama' => 'SSO Polibatam',             'deskripsi' => 'Login terintegrasi kampus.',                'url' => 'https://sso.polibatam.ac.id/if/flow/polibatam-sso/?next=%2F',    'is_active' => 1, 'created_at' => '2026-07-12 09:26:22', 'updated_at' => '2026-07-12 14:50:25'],
            ['id' => 29, 'id_kategori' => 5, 'nama' => 'SK Polibatam',              'deskripsi' => 'Pengelolaan surat keputusan',               'url' => 'https://sk.polibatam.ac.id/login',                                'is_active' => 1, 'created_at' => '2026-07-12 09:29:21', 'updated_at' => '2026-07-12 14:50:05'],
            ['id' => 30, 'id_kategori' => 6, 'nama' => 'SPMI Polibatam',            'deskripsi' => 'Penjaminan mutu internal',                  'url' => 'https://spmi.polibatam.ac.id/',                                   'is_active' => 1, 'created_at' => '2026-07-12 09:31:16', 'updated_at' => '2026-07-12 14:49:42'],
            ['id' => 32, 'id_kategori' => 6, 'nama' => 'Survey polibatam',          'deskripsi' => 'Survei layanan kampus',                     'url' => 'https://survey.polibatam.ac.id/',                                 'is_active' => 1, 'created_at' => '2026-07-12 09:33:38', 'updated_at' => '2026-07-12 14:49:20'],
            ['id' => 33, 'id_kategori' => 3, 'nama' => 'Transformasi Digital Polibatam', 'deskripsi' => 'Inovasi transformasi digital',         'url' => 'https://transdigital.polibatam.ac.id/',                           'is_active' => 1, 'created_at' => '2026-07-12 09:37:06', 'updated_at' => '2026-07-12 14:48:46'],
            ['id' => 34, 'id_kategori' => 6, 'nama' => 'UPA TIK Polibatam',        'deskripsi' => 'Layanan teknologi informasi',               'url' => 'https://upatik.polibatam.ac.id/',                                 'is_active' => 1, 'created_at' => '2026-07-12 09:38:42', 'updated_at' => '2026-07-12 14:48:18'],
            ['id' => 35, 'id_kategori' => 4, 'nama' => 'VLAB Polibatam',            'deskripsi' => 'Laboratorium virtual',                      'url' => 'https://vlab.polibatam.ac.id/',                                   'is_active' => 1, 'created_at' => '2026-07-12 09:43:01', 'updated_at' => '2026-07-12 14:47:55'],
            ['id' => 36, 'id_kategori' => 1, 'nama' => 'Wisuda Polibatam',          'deskripsi' => 'Administrasi kegiatan wisuda',              'url' => 'https://wisuda.polibatam.ac.id/',                                 'is_active' => 2, 'created_at' => '2026-07-12 09:47:19', 'updated_at' => '2026-07-12 14:47:36'],
            ['id' => 37, 'id_kategori' => 1, 'nama' => 'Registrasi PMP Polibatam',  'deskripsi' => 'Registrasi mahasiswa baru',                'url' => 'https://registrasi-pmb.polibatam.ac.id/auth/login',               'is_active' => 1, 'created_at' => '2026-07-12 13:27:40', 'updated_at' => '2026-07-12 14:47:13'],
            ['id' => 38, 'id_kategori' => 6, 'nama' => 'Staff Polibatam',           'deskripsi' => 'Informasi staf Polibatam',                  'url' => 'https://www.polibatam.ac.id/staff/',                              'is_active' => 1, 'created_at' => '2026-07-12 13:28:44', 'updated_at' => '2026-07-12 14:46:49'],
            ['id' => 39, 'id_kategori' => 3, 'nama' => 'PPI Polibatam',             'deskripsi' => 'Informasi inovasi penelitian',              'url' => 'https://ppi.polibatam.ac.id/',                                    'is_active' => 1, 'created_at' => '2026-07-12 13:29:55', 'updated_at' => '2026-07-12 14:54:13'],
            ['id' => 40, 'id_kategori' => 5, 'nama' => 'SITS Polibatam',            'deskripsi' => 'Pelatihan dan pengembangan SDM',            'url' => 'https://pelatihan.polibatam.ac.id/login',                         'is_active' => 1, 'created_at' => '2026-07-12 13:31:25', 'updated_at' => '2026-07-12 14:53:50'],
            ['id' => 41, 'id_kategori' => 3, 'nama' => 'Polibatam Cyber Labs',      'deskripsi' => 'Laboratorium keamanan siber',               'url' => 'https://pclabs.polibatam.ac.id/',                                 'is_active' => 1, 'created_at' => '2026-07-12 13:32:08', 'updated_at' => '2026-07-12 14:53:27'],
            ['id' => 42, 'id_kategori' => 6, 'nama' => 'SILAKIN Polibatam',         'deskripsi' => 'Layanan mahasiswa online',                  'url' => 'https://silakin.polibatam.ac.id/',                                'is_active' => 2, 'created_at' => '2026-07-12 13:34:13', 'updated_at' => '2026-07-12 14:53:03'],
            ['id' => 43, 'id_kategori' => 6, 'nama' => 'E-Kuisioner Polibatam',     'deskripsi' => 'Evaluasi layanan kampus',                   'url' => 'https://e-kuesioner.polibatam.ac.id/polibatam',                   'is_active' => 1, 'created_at' => '2026-07-12 13:35:30', 'updated_at' => '2026-07-12 14:52:30'],
            ['id' => 44, 'id_kategori' => 5, 'nama' => 'CLO Polibatam',             'deskripsi' => 'Pengelolaan capaian pembelajaran',          'url' => 'https://clo.polibatam.ac.id/login',                               'is_active' => 1, 'created_at' => '2026-07-12 13:36:27', 'updated_at' => '2026-07-12 14:52:00'],
            ['id' => 45, 'id_kategori' => 1, 'nama' => 'IF Polibatam',              'deskripsi' => 'Website Teknik Informatika',                'url' => 'https://if.polibatam.ac.id/',                                     'is_active' => 1, 'created_at' => '2026-07-12 13:37:42', 'updated_at' => '2026-07-12 14:51:42'],
        ]);
    }
}
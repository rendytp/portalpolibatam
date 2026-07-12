# Portal Polibatam

Portal Polibatam adalah aplikasi web berbasis **Laravel** (PHP) yang dikembangkan sebagai portal terpusat untuk berbagai layanan digital di lingkungan **Politeknik Negeri Batam**, seperti KRS Online dan Pembayaran UKT. Layanan-layanan tersebut dikelompokkan ke dalam beberapa kategori (Akademik, Keuangan, Kemahasiswaan) dan dapat dikelola melalui sistem dengan role pengguna (`admin` dan `user`). Proyek ini menggunakan struktur MVC standar Laravel dengan Blade sebagai template engine.

## 🚀 Tech Stack

- **Backend:** PHP, Laravel Framework
- **Frontend:** Blade Template, Vite
- **Database:** MySQL (atau sesuai konfigurasi `.env`)
- **Package Manager:** Composer (PHP), NPM (JavaScript)

## 📁 Struktur Direktori

```
portalpolibatam/
├── app/            # Logic aplikasi (Controller, Model, dll)
├── bootstrap/      # File bootstrap Laravel
├── config/         # File konfigurasi aplikasi
├── database/       # Migration, seeder, dan factory
├── public/         # Entry point aplikasi & asset publik
├── resources/      # View (Blade), asset frontend (CSS/JS)
├── routes/         # Definisi routing aplikasi
├── storage/        # File log, cache, dan upload
├── tests/          # Unit & feature testing
├── artisan         # CLI Laravel
├── composer.json   # Dependency PHP
└── package.json    # Dependency JavaScript
```

## ⚙️ Instalasi

Pastikan sudah terinstall **PHP >= 8.1**, **Composer**, **Node.js & NPM**, serta database (misal MySQL).

1. **Clone repository**
   ```bash
   git clone https://github.com/rendytp/portalpolibatam.git
   cd portalpolibatam
   ```

2. **Install dependency PHP**
   ```bash
   composer install
   ```

3. **Install dependency JavaScript**
   ```bash
   npm install
   ```

4. **Salin file environment**
   ```bash
   cp .env.example .env
   ```
   > Jika file `.env.example` belum ada, sesuaikan langsung file `.env` yang tersedia dengan konfigurasi lokal Anda.

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi database**

   Sesuaikan kredensial database pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=portalpolibatam
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Jalankan migrasi database**
   ```bash
   php artisan migrate
   ```
   Tambahkan `--seed` jika terdapat seeder data awal:
   ```bash
   php artisan migrate --seed
   ```

8. **Build asset frontend**
   ```bash
   npm run dev
   ```
   atau untuk production:
   ```bash
   npm run build
   ```

9. **Jalankan server lokal**
   ```bash
   php artisan serve
   ```

   Aplikasi dapat diakses di `http://127.0.0.1:8000`.

## 👤 Akun Default

Akun default dibuat otomatis melalui `DatabaseSeeder` saat menjalankan `php artisan migrate --seed` atau `php artisan db:seed`.

| username        | Role       | Password |
|-----------------|------------|----------|
| Admin           | Admin      | `123456`  |
| User            | Mahasiswa  | `123456`    |

> ⚠️ **Catatan:** Password di atas hanya untuk keperluan development/demo. Wajib diganti dengan password yang kuat sebelum aplikasi digunakan di environment production.

Selain akun, seeder juga otomatis mengisi data awal berupa **kategori** dan **layanan** portal, contohnya:

| Kategori      | Layanan          | URL                              |
|---------------|------------------|-----------------------------------|
| Akademik      | KRS Online       | https://krs.polibatam.ac.id      |
| Keuangan      | Pembayaran UKT   | https://ukt.polibatam.ac.id      |

Jalankan seeder dengan perintah:

```bash
php artisan db:seed
```

atau sekaligus dengan migrasi:

```bash
php artisan migrate --seed
```

## 🧪 Menjalankan Test

```bash
php artisan test
```

atau menggunakan PHPUnit langsung:

```bash
./vendor/bin/phpunit
```

## 🤝 Kontribusi

Kontribusi sangat terbuka untuk pengembangan Portal Polibatam:

1. Fork repository ini
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📄 Lisensi

Proyek ini dibangun di atas framework [Laravel](https://laravel.com), yang bersifat open-source dan dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

## 📬 Kontak

Untuk pertanyaan, saran, atau laporan bug, silakan buka [issue](https://github.com/rendytp/portalpolibatam/issues) di repository ini.

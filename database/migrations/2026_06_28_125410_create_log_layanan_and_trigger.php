<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Pembuatan Tabel log_layanan
        Schema::create('log_layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_layanan');
            $table->integer('status_lama');
            $table->integer('status_baru');
            // useCurrent() otomatis menerapkan waktu saat ini ketika data di-insert
            $table->timestamp('waktu')->useCurrent(); 
        });

        // 2. Pembuatan Trigger menggunakan DB::unprepared
        // (Tanpa menggunakan DELIMITER karena langsung dieksekusi secara blok oleh Laravel)
        DB::unprepared('
            CREATE TRIGGER after_layanan_update
            AFTER UPDATE ON layanan
            FOR EACH ROW
            BEGIN
                IF OLD.is_active <> NEW.is_active THEN
                    INSERT INTO log_layanan (id_layanan, status_lama, status_baru, waktu)
                    VALUES (OLD.id, OLD.is_active, NEW.is_active, NOW());
                END IF;
            END
        ');
    }

    public function down()
    {
        // Saat fungsi rollback dijalankan, hapus trigger terlebih dahulu, lalu drop tabel log
        DB::unprepared('DROP TRIGGER IF EXISTS after_layanan_update');
        Schema::dropIfExists('log_layanan');
    }
};
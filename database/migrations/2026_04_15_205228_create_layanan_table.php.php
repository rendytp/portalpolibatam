<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')
                ->references('id')
                ->on('kategori')
                ->onDelete('cascade');

            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('is_active')->default(1);

            $table->timestamps();
        });
        DB::statement('ALTER TABLE layanan ADD CONSTRAINT chk_status_layanan CHECK (is_active IN (0, 1, 2))');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE layanan DROP CONSTRAINT IF EXISTS chk_status_layanan');
        Schema::dropIfExists('layanan');
    }
};

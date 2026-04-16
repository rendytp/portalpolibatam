<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_favorit', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')
                  ->constrained('user')
                  ->cascadeOnDelete();

            $table->foreignId('id_layanan')
                  ->constrained('layanan')
                  ->cascadeOnDelete();;

            $table->timestamps();

            $table->unique(['id_user', 'id_layanan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_favorit');
    }
};

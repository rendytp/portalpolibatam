<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_custom_link', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')
                  ->constrained('user')
                  ->cascadeOnDelete();

            $table->string('nama');
            $table->string('url');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_custom_link');
    }
};

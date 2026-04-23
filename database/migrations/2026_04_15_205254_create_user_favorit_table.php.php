<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
    {
        Schema::create('user_favorit', function (Blueprint $table) {
            $table->id();
            
            // Cara modern: ini otomatis membuat kolom id_user (tipe unsignedBigInteger) 
            // dan langsung menghubungkannya ke tabel 'users'
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            
            // Kolom untuk ID layanan yang difavoritkan
            $table->foreignId('id_layanan')->constrained('layanan')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_favorit');
    }
};

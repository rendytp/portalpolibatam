<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
    {
        Schema::create('user_custom_link', function (Blueprint $table) {
            $table->id();
            
            // Ubah bagian ini agar merujuk ke tabel 'users'
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            
            // Kolom lainnya (misalnya judul link dan url)
            $table->string('judul_link');
            $table->string('url_link');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_custom_link');
    }
};

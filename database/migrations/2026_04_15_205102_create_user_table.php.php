    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
       public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Ini yang penting: gunakan username, bukan name
            $table->string('nama')->nullable();
            $table->string('username')->unique(); 
            $table->string('password');
            $table->string('role')->default('Staff'); // Tambahkan role
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

        public function down(): void
        {
            Schema::dropIfExists('users');
        }
    };

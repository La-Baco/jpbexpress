    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('barangs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pelanggan_id')
                    ->constrained('pelanggans')
                    ->onDelete('cascade'); // hapus pelanggan -> hapus barangnya

                $table->foreignId('pengiriman_id')
                    ->constrained('pengirimans')
                    ->onDelete('cascade'); // hapus pengiriman -> hapus semua barangnya

                $table->enum('kategori', ['cod', 'non-cod', 'order']);
                $table->decimal('harga', 15, 2)->default(0);
                $table->enum('status', ['proses', 'tertunda', 'selesai'])->default('proses');
                $table->text('catatan')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('barangs');
        }
    };

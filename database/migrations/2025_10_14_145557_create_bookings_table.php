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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        // Ini adalah "kunci asing" untuk menghubungkan ke tabel lain
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('mobil_elf_id')->constrained('mobil_elf');
        $table->foreignId('supir_id')->nullable()->constrained('supir');

        $table->date('tanggal_mulai_sewa');
        $table->date('tanggal_akhir_sewa');
        $table->bigInteger('total_harga');
        
        $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
        
        $table->text('catatan_user')->nullable(); // Catatan dari user, misal: "jemput di deket indomaret"
        $table->text('catatan_admin')->nullable(); // Catatan dari admin

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

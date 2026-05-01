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
        Schema::create('supir', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nomor_hp')->unique(); // nomor hp harus unik, gaboleh sama
        $table->string('nomor_sim')->unique(); // nomor sim juga harus unik
        $table->string('foto_supir')->nullable(); // nama file foto, boleh kosong
        $table->text('alamat')->nullable();
        $table->enum('status', ['tersedia', 'bertugas', 'libur'])->default('tersedia');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supir');
    }
};

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
       Schema::create('mobil_elf', function (Blueprint $table) {
        $table->id(); // Ini buat kolom nomor urut otomatis (Primary Key)
        $table->string('nama_mobil'); // Buat nama/tipe elf (misal: Elf Long, Short)
        $table->string('plat_nomor')->unique(); // Plat nomor, harus unik gaboleh ada yg sama
        $table->integer('kapasitas_penumpang'); // Jumlah kursi, isinya angka
        $table->string('foto_mobil')->nullable(); // Nama file fotonya, boleh kosong
        $table->text('deskripsi')->nullable(); // Deskripsi lengkap, boleh kosong
        $table->enum('status', ['tersedia', 'dipesan', 'perbaikan'])->default('tersedia'); // Status ketersediaan mobil
        $table->timestamps(); // Ini buat kolom created_at dan updated_at otomatistable->enum('transmisi', ['Manual', 'Otomatis'])->default('Manual'); // Jenis transmisi
        $table->bigInteger('harga_sewa_per_hari'); // Harga sewa, pake bigInteger biar bisa
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil_elf');
    }
};

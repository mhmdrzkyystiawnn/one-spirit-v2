<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilElf extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit jika nama model berbeda dari nama tabel
    protected $table = 'mobil_elf';

    // Tentukan kolom mana saja yang boleh diisi secara massal
    protected $fillable = [
        'nama_mobil',
        'plat_nomor',
        'kapasitas_penumpang',
        'foto_mobil',
        'deskripsi',
        'transmisi',
        'harga_sewa_per_hari',
        'status',
    ];

    // --- TAMBAHKAN JEMBATAN INI ---
    /**
     * Mendefinisikan bahwa satu mobil bisa memiliki BANYAK review.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

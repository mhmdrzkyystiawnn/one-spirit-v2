<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'mobil_elf_id',
        'supir_id',
        'tanggal_mulai_sewa',
        'tanggal_akhir_sewa',
        'total_harga',
        'status',
        'catatan_user',
        'catatan_admin',
    ];

    // --- INI BAGIAN PENTING: DEFINISI HUBUNGAN ---

    /**
     * Mendefinisikan bahwa satu booking PASTI dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan bahwa satu booking PASTI untuk satu MobilElf.
     */
    public function mobilElf(): BelongsTo
    {
        return $this->belongsTo(MobilElf::class);
    }

    /**
     * Mendefinisikan bahwa satu booking bisa jadi punya satu Supir.
     */
    public function supir(): BelongsTo
    {
        return $this->belongsTo(Supir::class);
    }

    // Tambahkan di dalam class Booking
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;

    // Kalo nama model dan tabel beda, kita kasih tau nama tabelnya
    protected $table = 'supir';

    // Kolom yang boleh diisi lewat form
    protected $fillable = [
        'nama_lengkap',
        'nomor_hp',
        'nomor_sim',
        'foto_supir',
        'alamat',
        'status',
    ];

    /**
     * Mendefinisikan bahwa satu supir bisa memiliki BANYAK booking.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

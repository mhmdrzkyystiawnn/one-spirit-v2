<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'mobil_elf_id',
        'rating',
        'komentar',
    ];

    /**
     * Sebuah review pasti dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Sebuah review pasti untuk satu mobil elf.
     */
    public function mobilElf()
    {
        return $this->belongsTo(MobilElf::class);
    }

    /**
     * Sebuah review pasti terkait dengan satu booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
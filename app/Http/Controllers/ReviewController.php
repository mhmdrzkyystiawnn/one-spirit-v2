<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Menampilkan form review
    public function create(Booking $booking)
    {
        // Pastikan hanya user yang bersangkutan yang bisa review
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('review.create', ['booking' => $booking]);
    }

    // Menyimpan review
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id|unique:reviews,booking_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        $booking = Booking::find($request->booking_id);

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'mobil_elf_id' => $booking->mobil_elf_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('dashboard')->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
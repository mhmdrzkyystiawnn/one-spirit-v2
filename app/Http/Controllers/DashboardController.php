<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard user beserta riwayat bookingnya.
     */
    public function index()
    {
        $userId = Auth::id();

        $bookings = Booking::where('user_id', $userId)
            ->with(['mobilElf', 'supir'])
            ->latest()
            ->get();

        // Ambil nomor WA dari file .env
        $adminWhatsapp = env('ADMIN_WHATSAPP_NUMBER');

        return view('dashboard', [
            'daftar_booking' => $bookings,
            'admin_whatsapp' => $adminWhatsapp,
        ]);
    }

    /**
     * Menampilkan halaman invoice untuk booking tertentu.
     */
    public function showInvoice(Booking $booking)
    {
        // PENTING: Keamanan!
        // Pastikan hanya user yang memiliki booking ini yang bisa melihat invoicenya.
        if (auth()->id() !== $booking->user_id) {
            abort(403, 'Unauthorized action.'); // Tendang user jika mencoba melihat invoice orang lain
        }

        // Kirim data booking ke view 'invoice'
        return view('invoice', [
            'booking' => $booking,
        ]);
    }
}

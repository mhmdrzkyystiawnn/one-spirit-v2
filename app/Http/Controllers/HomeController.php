<?php

namespace App\Http\Controllers;

use App\Models\MobilElf;
use App\Models\Booking;
use App\Models\Supir;
use App\Models\Review; // <-- 1. Panggil model Review
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBookingAdminNotification;

class HomeController extends Controller
{
    // --- FUNGSI INI KITA UPGRADE ---
    public function index()
    {
        // 2. Ambil 3 mobil dengan rating tertinggi sebagai unggulan
        $mobilUnggulan = MobilElf::where('status', 'tersedia')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(3)
            ->get();

        // 3. Ambil 3 review terbaru dari user
        $reviewTerbaru = Review::with('user', 'mobilElf')
            ->latest()
            ->take(3)
            ->get();

        // 4. Kirim semua data itu ke view
        return view('home', [
            'mobil_unggulan' => $mobilUnggulan,
            'review_terbaru' => $reviewTerbaru,
        ]);
    }

    // ... (fungsi-fungsi lain biarkan sama) ...
    public function katalog(Request $request)
    {
        $query = MobilElf::where('status', 'tersedia');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $tanggalMulai = $request->tanggal_mulai;
            $tanggalAkhir = $request->tanggal_akhir;

            $unavailableCarIds = Booking::where(function ($query) use ($tanggalMulai, $tanggalAkhir) {
                $query->where('tanggal_mulai_sewa', '<=', $tanggalAkhir)
                      ->where('tanggal_akhir_sewa', '>=', $tanggalMulai);
            })->pluck('mobil_elf_id')->unique();

            $query->whereNotIn('id', $unavailableCarIds);
        }

        $mobil_elfs = $query->with('reviews.user')
                            ->withAvg('reviews', 'rating')
                            ->latest()
                            ->get();

        return view('katalog', [
            'daftar_mobil' => $mobil_elfs
        ]);
    }

    public function showDetail(MobilElf $mobil)
    {
        $mobil->load('reviews.user');

        return view('detail-mobil', [
            'mobil' => $mobil
        ]);
    }

    public function showBookingForm(MobilElf $mobil)
    {
        if (!Auth::check()) {
            session(['url.intended' => route('booking.form', $mobil->id)]);
            return redirect()->route('login')->with('info', 'Anda harus login terlebih dahulu untuk melakukan booking.');
        }

        $supirs = Supir::where('status', 'tersedia')->get();

        return view('booking', [
            'mobil' => $mobil,
            'daftar_supir' => $supirs,
        ]);
    }

    public function testimonials()
    {
        $reviews = Review::with('user', 'mobilElf')
            ->latest()
            ->get();

        return view('testimonials', [
            'reviews' => $reviews,
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function getAvailableDrivers(Request $request)
    {
        $request->validate([
            'mobil_elf_id' => 'required|exists:mobil_elf,id',
            'tanggal_mulai_sewa' => 'required|date|after_or_equal:today',
            'tanggal_akhir_sewa' => 'required|date|after_or_equal:tanggal_mulai_sewa',
        ]);

        $mobilElfId = $request->mobil_elf_id;
        $tanggalMulai = $request->tanggal_mulai_sewa;
        $tanggalAkhir = $request->tanggal_akhir_sewa;

        // Check if car is already booked
        $carBooked = Booking::where('mobil_elf_id', $mobilElfId)
            ->where(function ($query) use ($tanggalMulai, $tanggalAkhir) {
                $query->where('tanggal_mulai_sewa', '<=', $tanggalAkhir)
                      ->where('tanggal_akhir_sewa', '>=', $tanggalMulai);
            })->exists();

        if ($carBooked) {
            return response()->json([
                'available' => false,
                'message' => 'Maaf, mobil ini sudah dibooking pada rentang tanggal tersebut.',
                'drivers' => []
            ]);
        }

        // Get available drivers
        $unavailableDriverIds = Booking::where(function ($query) use ($tanggalMulai, $tanggalAkhir) {
            $query->where('tanggal_mulai_sewa', '<=', $tanggalAkhir)
                  ->where('tanggal_akhir_sewa', '>=', $tanggalMulai);
        })->pluck('supir_id')->unique();

        $availableDrivers = Supir::where('status', 'tersedia')
            ->whereNotIn('id', $unavailableDriverIds)
            ->get(['id', 'nama_lengkap']);

        return response()->json([
            'available' => true,
            'drivers' => $availableDrivers
        ]);
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'mobil_elf_id'       => 'required|exists:mobil_elf,id',
            'supir_id'           => 'required|exists:supir,id',
            'tanggal_mulai_sewa' => 'required|date|after_or_equal:today',
            'tanggal_akhir_sewa' => 'required|date|after_or_equal:tanggal_mulai_sewa',
        ]);

        $tanggalMulaiRequest = $request->tanggal_mulai_sewa;
        $tanggalAkhirRequest = $request->tanggal_akhir_sewa;

        // Check if car is already booked
        $mobilBooked = Booking::where('mobil_elf_id', $request->mobil_elf_id)
            ->where(function ($query) use ($tanggalMulaiRequest, $tanggalAkhirRequest) {
                $query->where('tanggal_mulai_sewa', '<=', $tanggalAkhirRequest)
                      ->where('tanggal_akhir_sewa', '>=', $tanggalMulaiRequest);
            })->exists();
        if ($mobilBooked) {
            return back()->withInput()->with('error', 'Maaf, mobil ini sudah dibooking pada rentang tanggal tersebut.');
        }

        // Check if driver is already booked
        $supirBooked = Booking::where('supir_id', $request->supir_id)
            ->where(function ($query) use ($tanggalMulaiRequest, $tanggalAkhirRequest) {
                $query->where('tanggal_mulai_sewa', '<=', $tanggalAkhirRequest)
                      ->where('tanggal_akhir_sewa', '>=', $tanggalMulaiRequest);
            })->exists();
        if ($supirBooked) {
            return back()->withInput()->with('error', 'Maaf, supir ini tidak tersedia pada rentang tanggal tersebut.');
        }

        $newBooking = Booking::create([
            'user_id'            => auth()->id(),
            'mobil_elf_id'       => $request->mobil_elf_id,
            'supir_id'           => $request->supir_id,
            'tanggal_mulai_sewa' => $request->tanggal_mulai_sewa,
            'tanggal_akhir_sewa' => $request->tanggal_akhir_sewa,
            'total_harga'        => 0, // Price to be negotiated via WhatsApp
            'status'             => 'pending',
        ]);

        Mail::to('admin@bookingelf.com')->send(new NewBookingAdminNotification($newBooking));

        return redirect()->route('dashboard')->with('success', 'Pengajuan booking Anda berhasil! Silakan hubungi admin via WhatsApp untuk diskusi harga dan finalisasi pesanan.');
    }
}

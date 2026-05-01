<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MobilElf;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'mobilElf'])->latest()->get();

        return view('admin.booking.index', [
            'daftar_booking' => $bookings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data user dan mobil
        $users = User::where('role', 'user')->get(); // Kita hanya ambil user biasa, bukan admin
        $mobil_elfs = MobilElf::where('status', 'tersedia')->get(); // Hanya mobil yang statusnya tersedia

        return view('admin.booking.create', [
            'users' => $users,
            'mobil_elfs' => $mobil_elfs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'mobil_elf_id' => 'required|exists:mobil_elf,id',
            'tanggal_mulai_sewa' => 'required|date',
            'tanggal_akhir_sewa' => 'required|date|after_or_equal:tanggal_mulai_sewa',
            'total_harga' => 'required|integer',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        // 2. Simpan data ke database
        Booking::create($request->all());

        // 3. Alihkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('booking.index')->with('success', 'Data booking baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // Ambil daftar supir yang statusnya 'tersedia'
        $supirs = Supir::where('status', 'tersedia')->get();

        return view('admin.booking.edit', [
            'booking' => $booking,
            'supirs' => $supirs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // 1. Aturan validasi
        $request->validate([
            'supir_id' => 'nullable|exists:supir,id',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'total_harga' => 'required|integer',
            'status_supir' => 'nullable|in:tersedia,bertugas,libur',
            'status_mobil' => 'required|in:tersedia,dipesan,perbaikan',
        ]);

        // 2. Update data booking
        $booking->update([
            'supir_id' => $request->supir_id,
            'status' => $request->status,
            'total_harga' => $request->total_harga,
        ]);

        // 3. Update status supir jika ada
        if ($booking->supir && $request->status_supir) {
            $booking->supir->update(['status' => $request->status_supir]);
        }

        // 4. Update status mobil
        $booking->mobilElf->update(['status' => $request->status_mobil]);

        // 5. Redirect kembali
        return redirect()->route('booking.index')->with('success', 'Data booking berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Hapus data dari database
        $booking->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('booking.index')->with('success', 'Data booking berhasil dihapus!');
    }
}

{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')

    <h1>Manajemen Booking</h1>
    <p>Ini adalah daftar semua pesanan yang masuk.</p>
    <br>
    <a href="{{ route('booking.create') }}" class="btn">Tambah Booking Manual</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pemesan</th>
                <th>Mobil yang Dipesan</th>
                <th>Tanggal Sewa</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftar_booking as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->mobilElf->nama_mobil }}</td>
                    <td>{{ $booking->tanggal_mulai_sewa }} s/d {{ $booking->tanggal_akhir_sewa }}</td>
                    <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                    <td class="status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</td>
                    <td>
                        <a href="{{ route('booking.edit', $booking->id) }}" class="btn-edit">Edit/Detail</a>

                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus"
                                onclick="return confirm('Yakin mau hapus data booking ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada pesanan yang masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection

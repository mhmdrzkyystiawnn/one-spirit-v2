{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')
    <h1>Detail & Edit Booking</h1>

    <div class="booking-details">
        <h3>Detail Pesanan</h3>
        <p><strong>Nama Pemesan:</strong> {{ $booking->user->name }}</p>
        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
        <p><strong>Mobil Dipesan:</strong> {{ $booking->mobilElf->nama_mobil }} ({{ $booking->mobilElf->plat_nomor }})</p>
        <p><strong>Tanggal Sewa:</strong> {{ $booking->tanggal_mulai_sewa }} s/d {{ $booking->tanggal_akhir_sewa }}</p>
    </div>

    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="total_harga">Total Harga</label>
            <input type="number" id="total_harga" name="total_harga" value="{{ $booking->total_harga }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status Booking</label>
            <select id="status" name="status">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="form-group">
            <label for="supir_id">Pilih Supir (Assign Supir)</label>
            <select id="supir_id" name="supir_id">
                <option value="">-- Belum Ditugaskan --</option>
                @if ($booking->supir)
                    <option value="{{ $booking->supir->id }}" selected>{{ $booking->supir->nama_lengkap }} (Sedang
                        Bertugas untuk booking ini)</option>
                @endif
                @foreach ($supirs as $supir)
                    <option value="{{ $supir->id }}">{{ $supir->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>
        @if ($booking->supir)
            <div class="form-group">
                <label for="status_supir">Status Supir</label>
                <select id="status_supir" name="status_supir">
                    <option value="tersedia" {{ $booking->supir->status == 'tersedia' ? 'selected' : '' }}>Tersedia
                    </option>
                    <option value="bertugas" {{ $booking->supir->status == 'bertugas' ? 'selected' : '' }}>Bertugas
                    </option>
                    <option value="libur" {{ $booking->supir->status == 'libur' ? 'selected' : '' }}>Libur</option>
                </select>
            </div>
        @endif
        <div class="form-group">
            <label for="status_mobil">Status Mobil</label>
            <select id="status_mobil" name="status_mobil">
                <option value="tersedia" {{ $booking->mobilElf->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="dipesan" {{ $booking->mobilElf->status == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                <option value="perbaikan" {{ $booking->mobilElf->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan
                </option>
            </select>
        </div>

        <button type="submit" class="btn">Update Booking</button>
        <a href="{{ route('booking.index') }}" class="btn btn-back">Kembali</a>
    </form>
@endsection

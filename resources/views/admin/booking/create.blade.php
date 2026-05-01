{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Form Tambah Booking Manual</h1>
    <br>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Pilih User Pemesan</label>
            <select id="user_id" name="user_id" required>
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} - ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="mobil_elf_id">Pilih Mobil</label>
            <select id="mobil_elf_id" name="mobil_elf_id" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($mobil_elfs as $mobil)
                    <option value="{{ $mobil->id }}">{{ $mobil->nama_mobil }} - ({{ $mobil->plat_nomor }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_mulai_sewa">Tanggal Mulai Sewa</label>
            <input type="date" id="tanggal_mulai_sewa" name="tanggal_mulai_sewa" required>
        </div>
        <div class="form-group">
            <label for="tanggal_akhir_sewa">Tanggal Akhir Sewa</label>
            <input type="date" id="tanggal_akhir_sewa" name="tanggal_akhir_sewa" required>
        </div>
        <div class="form-group">
            <label for="total_harga">Total Harga</label>
            <input type="number" id="total_harga" name="total_harga" placeholder="Contoh: 3000000" required>
        </div>
        <div class="form-group">
            <label for="status">Status Booking</label>
            <select id="status" name="status">
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn">Simpan Booking</button>
        <a href="{{ route('booking.index') }}" class="btn btn-back">Batal</a>
    </form>
@endsection

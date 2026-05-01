{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Form Tambah Supir Baru</h1>
    <p>Silakan isi data supir yang baru di bawah ini.</p>
    <br>

    <form action="{{ route('supir.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap supir" required>
        </div>
        <div class="form-group">
            <label for="nomor_hp">Nomor HP</label>
            <input type="text" id="nomor_hp" name="nomor_hp" placeholder="Contoh: 081234567890" required>
        </div>
        <div class="form-group">
            <label for="nomor_sim">Nomor SIM A</label>
            <input type="text" id="nomor_sim" name="nomor_sim" placeholder="Masukkan nomor SIM supir" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat (Opsional)</label>
            <textarea id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat lengkap supir"></textarea>
        </div>

        <button type="submit" class="btn">Simpan Data Supir</button>
        <a href="{{ route('supir.index') }}" class="btn btn-back">Batal</a>
    </form>

@endsection
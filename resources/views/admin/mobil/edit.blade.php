{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')
    <h1>Form Edit Data Mobil Elf</h1>

    {{-- KESALAHANNYA ADA DI SINI, SEKARANG SUDAH BENAR --}}
    <form action="{{ route('mobil.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_mobil">Nama/Tipe Mobil</label>
            <input type="text" id="nama_mobil" name="nama_mobil" value="{{ $mobil->nama_mobil }}" required>
        </div>
        <div class="form-group">
            <label for="plat_nomor">Plat Nomor</label>
            <input type="text" id="plat_nomor" name="plat_nomor" value="{{ $mobil->plat_nomor }}" required>
        </div>
        <div class="form-group">
            <label for="kapasitas_penumpang">Kapasitas Penumpang</label>
            <input type="number" id="kapasitas_penumpang" name="kapasitas_penumpang"
                value="{{ $mobil->kapasitas_penumpang }}" required>
        </div>
        <div class="form-group">
            <label for="harga_sewa_per_hari">Harga Sewa / Hari</label>
            <input type="number" id="harga_sewa_per_hari" name="harga_sewa_per_hari"
                value="{{ $mobil->harga_sewa_per_hari }}" required>
        </div>
        <div class="form-group">
            <label for="transmisi">Transmisi</label>
            <select id="transmisi" name="transmisi">
                <option value="Manual" {{ $mobil->transmisi == 'Manual' ? 'selected' : '' }}>Manual</option>
                <option value="Otomatis" {{ $mobil->transmisi == 'Otomatis' ? 'selected' : '' }}>Otomatis</option>
            </select>
        </div>

        {{-- BAGIAN FOTO SUDAH BENAR --}}
        <div class="form-group">
            <label for="foto_mobil">Ganti Foto Mobil (Opsional)</label>
            <input type="file" id="foto_mobil" name="foto_mobil">
            <small>Kosongkan jika tidak ingin mengganti foto.</small>
            @if($mobil->foto_mobil)
                <div style="margin-top: 10px;">
                    <p>Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $mobil->foto_mobil) }}" alt="Foto {{ $mobil->nama_mobil }}"
                        width="150">
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi (Opsional)</label>
            <textarea id="deskripsi" name="deskripsi" rows="4">{{ $mobil->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn">Update Data</button>
        <a href="{{ route('mobil.index') }}" class="btn">Batal</a>
    </form>
@endsection
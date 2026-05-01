{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')
     @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Form Tambah Mobil Elf Baru</h1>
    <p>Silakan isi data mobil elf yang baru di bawah ini.</p>
    <br>
        <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="foto_mobil">Foto Mobil</label>
        <input type="file" id="foto_mobil" name="foto_mobil" required>
    </div>
        <div class="form-group">
            <label for="nama_mobil">Nama/Tipe Mobil</label>
            <input type="text" id="nama_mobil" name="nama_mobil" placeholder="Contoh: Elf Long 19 Seat" required>
        </div>
        <div class="form-group">
            <label for="plat_nomor">Plat Nomor</label>
            <input type="text" id="plat_nomor" name="plat_nomor" placeholder="Contoh: B 1234 XYZ" required>
        </div>
        <div class="form-group">
            <label for="kapasitas_penumpang">Kapasitas Penumpang</label>
            <input type="number" id="kapasitas_penumpang" name="kapasitas_penumpang" placeholder="Contoh: 19" required>
        </div>
        <div class="form-group">
            <label for="harga_sewa_per_hari">Harga Sewa / Hari</label>
            <input type="number" id="harga_sewa_per_hari" name="harga_sewa_per_hari" placeholder="Contoh: 1500000" required>
        </div>
        <div class="form-group">
            <label for="transmisi">Transmisi</label>
            <select id="transmisi" name="transmisi">
                <option value="Manual">Manual</option>
                <option value="Otomatis">Otomatis</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi (Opsional)</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan fasilitas mobil seperti AC, TV, Karaoke, dll."></textarea>
        </div>

        <button type="submit" class="btn">Simpan Data Mobil</button>
        <a href="{{ route('mobil.index') }}" class="btn btn-back">Batal</a>
    </form>
@endsection
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')

    <h1>Form Edit Data Supir</h1>

    <form action="{{ route('supir.update', $supir->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ $supir->nama_lengkap }}" required>
        </div>
        <div class="form-group">
            <label for="nomor_hp">Nomor HP</label>
            <input type="text" id="nomor_hp" name="nomor_hp" value="{{ $supir->nomor_hp }}" required>
        </div>
        <div class="form-group">
            <label for="nomor_sim">Nomor SIM A</label>
            <input type="text" id="nomor_sim" name="nomor_sim" value="{{ $supir->nomor_sim }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat (Opsional)</label>
            <textarea id="alamat" name="alamat" rows="4">{{ $supir->alamat }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="tersedia" {{ $supir->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="bertugas" {{ $supir->status == 'bertugas' ? 'selected' : '' }}>Bertugas</option>
                <option value="libur" {{ $supir->status == 'libur' ? 'selected' : '' }}>Libur</option>
            </select>
        </div>

        <button type="submit" class="btn">Update Data</button>
        <a href="{{ route('supir.index') }}" class="btn btn-back">Batal</a>
    </form>
@endsection
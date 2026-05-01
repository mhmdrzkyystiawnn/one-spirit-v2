{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h1>Manajemen Mobil Elf</h1>
    <p>Ini adalah halaman untuk mengelola data mobil elf di rentalmu.</p>
    <br>
    <a href="{{ route('mobil.create') }}"" class="btn">Tambah Mobil Baru</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mobil</th>
                <th>Plat Nomor</th>
                <th>Harga Sewa/Hari</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftar_mobil as $mobil)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mobil->nama_mobil }}</td>
                    <td>{{ $mobil->plat_nomor }}</td>
                    <td>Rp {{ number_format($mobil->harga_sewa_per_hari, 0, ',', '.') }}</td>
                    <td>{{ $mobil->status }}</td>
                    <td>
                        <a href="{{ route('mobil.edit', $mobil->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('mobil.destroy', $mobil->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus"
                                onclick="return confirm('Yakin mau hapus mobil ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Data mobil masih kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection

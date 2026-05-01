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

    <h1>Manajemen Supir</h1>
    <p>Ini adalah halaman untuk mengelola data supir di rentalmu.</p>
    <br>
    <a href="{{ route('supir.create') }}" class="btn">Tambah Supir Baru</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Nomor HP</th>
                <th>Nomor SIM</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftar_supir as $supir)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supir->nama_lengkap }}</td>
                    <td>{{ $supir->nomor_hp }}</td>
                    <td>{{ $supir->nomor_sim }}</td>
                    <td>{{ $supir->status }}</td>
                    <td>
                        <a href="{{ route('supir.edit', $supir->id) }}" class="btn-edit">Edit</a>

                        <form action="{{ route('supir.destroy', $supir->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus"
                                onclick="return confirm('Yakin mau hapus data supir ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Data supir masih kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


            @endsection
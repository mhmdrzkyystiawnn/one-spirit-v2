{{-- 1. Bilang ke Laravel kita mau pakai 'bingkai' admin --}}
@extends('layouts.admin')

{{-- 2. Mulai bagian konten yang mau dimasukin ke 'bingkai' --}}
@section('content')
    <h1>Form Edit Data User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Nomor HP</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="profile_picture">Foto Profil</label>
            @if($user->profile_picture)
                <div>
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Current Profile Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                    <p>Foto saat ini</p>
                </div>
            @endif
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            <small>Kosongkan jika tidak ingin mengubah foto profil.</small>
        </div>
        <hr>
        <p><strong>Ganti Password (Opsional)</strong></p>
        <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password">
            <small>Kosongkan jika tidak ingin mengubah password.</small>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn">Update Data</button>
        <a href="{{ route('users.index') }}" class="btn btn-back">Batal</a>
    </form>
@endsection
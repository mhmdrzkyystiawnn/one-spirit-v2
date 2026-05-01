@extends('layouts.app')

@section('title', 'Profil Saya - One Spirit')

@section('content')
{{-- 
    Kita pake style .container yang sama kayak halaman booking/review 
    (max-width: 800px, margin: auto, background: white, etc)
--}}
<div class="container">
    <h1 style="color: var(--primary); font-size: 28px; text-align: center; margin-bottom: 30px;">
        Profil Saya
    </h1>

    {{-- BAGIAN 1: UPDATE INFORMASI PROFIL --}}
    <div class="profile-section">
        <h2 class="profile-section-title">Informasi Akun</h2>
        <p class="profile-section-description">Perbarui nama dan alamat email Anda.</p>

        {{-- 
            NOTE: 
            Di file profile.edit.blade.php bawaan, 
            $user dikirim otomatis sama controller-nya
        --}}
        <form method="post" action="{{ route('profile.update') }}" style="margin-top: 20px;">
            @csrf
            @method('patch')

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success" style="margin-bottom: 15px;">
                    Berhasil disimpan.
                </div>
            @endif

            <div class="form-group">
                <label for="name">Nama</label>
                <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')
                    <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>

    {{-- BAGIAN 2: UPDATE PASSWORD --}}
    <div class="profile-section">
        <h2 class="profile-section-title">Ubah Password</h2>
        <p class="profile-section-description">Pastikan Anda menggunakan password yang panjang dan acak.</p>

        <form method="post" action="{{ route('password.update') }}" style="margin-top: 20px;">
            @csrf
            @method('put')

            @if (session('status') === 'password-updated')
                <div class="alert alert-success" style="margin-bottom: 15px;">
                    Password berhasil diubah.
                </div>
            @endif

            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input id="current_password" name="current_password" type="password" class="form-input" required>
                @error('current_password', 'updatePassword')
                    <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input id="password" name="password" type="password" class="form-input" required>
                 @error('password', 'updatePassword')
                    <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" required>
            </div>

            <button type="submit" class="btn">Simpan Password</button>
        </form>
    </div>

    {{-- BAGIAN 3: HAPUS AKUN --}}
    <div class="profile-section danger-zone">
        <h2 class="profile-section-title">Hapus Akun</h2>
        <p class="profile-section-description">
            Setelah akun Anda dihapus, semua data akan dihapus permanen.
        </p>
        
        {{-- Kita pake Alpine.js (x-data) yang udah ada buat modal --}}
        <div x-data="{ confirmingUserDeletion: false }" style="margin-top: 20px;">
            
            {{-- Tombol 'Hapus Akun Saya' (pake class .btn-hapus yang udah ada) --}}
            <button type="button" @click="confirmingUserDeletion = true" class="btn-hapus" style="padding: 12px 20px; font-size: 15px;">
                Hapus Akun Saya
            </button>
            
            {{-- Modal Konfirmasi --}}
            <div class="modal-backdrop" x-show="confirmingUserDeletion" style="display: none;">
                <div class="modal-content" @click.away="confirmingUserDeletion = false">
                    
                    <form method="post" action="{{ route('profile.destroy') }}" style="margin: 0;">
                        @csrf
                        @method('delete')
                        
                        <h3 style="margin-top: 0; color: var(--primary);">Anda yakin ingin menghapus akun?</h3>
                        <p style="color: #555;">Tindakan ini tidak dapat dibatalkan. Masukkan password Anda untuk mengkonfirmasi.</p>
                        
                        <div class="form-group">
                            <label for="password_delete" style="font-weight: bold;">Password</label>
                            <input id="password_delete" name="password" type="password" class="form-input" required>
                            @error('password', 'userDeletion')
                                <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="modal-actions">
                            <button type="button" class="btn-secondary" @click="confirmingUserDeletion = false">
                                Batal
                            </button>
                            <button type="submit" class="btn-hapus">
                                Hapus Akun Permanen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
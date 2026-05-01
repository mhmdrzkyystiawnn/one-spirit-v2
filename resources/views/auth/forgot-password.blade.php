<x-guest-layout>
    {{-- Kita pake style .container yang sama kayak halaman login --}}
    <div class="container" style="max-width: 450px;">

        <h1 style="color: var(--primary); font-size: 24px; text-align: center; margin-bottom: 15px;">
            Lupa Password Anda?
        </h1>

        <p style="font-size: 15px; color: #555; text-align: center; margin-bottom: 25px;">
            Tidak masalah. Masukkan alamat email Anda, kami akan mengirimkan link untuk membuat password baru.
        </p>

        {{-- Kita biarin ini, tapi tambahin style biar mirip alert --}}
        <x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan alamat email terdaftar">
                {{-- Ini buat nampilin error validasi email --}}
                <x-input-error :messages="$errors->get('email')" class="mt-2" style="font-size: 14px;" />
            </div>

            {{-- Tombol Kirim Link --}}
            <button type="submit" class="btn" style="width: 100%; margin-top: 25px;">
                Kirim Link Reset Password
            </button>

            {{-- Link kembali ke Login (Opsional) --}}
            <div style="text-align: center; margin-top: 20px; font-size: 14px;">
                <a href="{{ route('login') }}" class="forgot-password-link">
                    &larr; Kembali ke Halaman Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>

{{-- 
    Tambahkan CSS ini ke app.css kamu
    buat styling session status biar mirip alert
--}}
<style>

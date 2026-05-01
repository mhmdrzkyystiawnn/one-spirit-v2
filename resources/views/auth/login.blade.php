{{-- 
    Kita tetep pake guest-layout, tapi isinya kita ubah total
    pake html biasa + class css kita
--}}
<x-guest-layout>

    {{-- Kita pake style .container yang sama kayak halaman profile --}}
    <div class="container" style="max-width: 450px;"> {{-- Dibuat lebih kecil --}}

        {{-- Logo (Opsional, bisa ditambahin di atas H1 kalo mau) --}}
        {{-- <div style="text-align: center; margin-bottom: 20px;">
            <a href="/">
                <img src="/logo.png" alt="Logo One Spirit" style="height: 50px;">
            </a>
        </div> --}}
        
        <h1 style="color: var(--primary); font-size: 24px; text-align: center; margin-bottom: 25px;">
            Selamat Datang Kembali
        </h1>

        <!-- Session Status (Misal: link reset password terkirim) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan alamat email Anda">
                {{-- Ini buat nampilin error validasi email --}}
                <x-input-error :messages="$errors->get('email')" class="mt-2" style="font-size: 14px;" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-input"
                       type="password"
                       name="password"
                       required autocomplete="current-password"
                       placeholder="Masukkan password Anda">
                {{-- Ini buat nampilin error validasi password --}}
                <x-input-error :messages="$errors->get('password')" class="mt-2" style="font-size: 14px;" />
            </div>

            <!-- Remember Me -->
            <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
                <label for="remember_me" style="display: flex; align-items: center; margin-bottom: 0; font-weight: normal; color: #555;">
                    <input id="remember_me" type="checkbox" name="remember" class="remember-checkbox">
                    <span style="margin-left: 8px; font-size: 14px;">Ingat Saya</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">
                        Lupa Password?
                    </a>
                @endif
            </div>

            {{-- Tombol Login (pake class .btn) --}}
            <button type="submit" class="btn" style="width: 100%; margin-top: 25px;">
                Log In
            </button>

            {{-- Link ke Register (Opsional) --}}
            <div style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
                Belum punya akun? <a href="{{ route('register') }}" class="register-link">Daftar di sini</a>
            </div>

        </form>
    </div>
</x-guest-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Kita pake title dinamis atau nama app --}}
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Pastikan ini manggil app.css dan app.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: var(--background);"> {{-- Ganti background body --}}
    
    {{-- Kita buat container baru buat layout login/register --}}
    <div class="guest-layout-container">
        
        {{-- Logo (Bisa pake img atau teks) --}}
        <div class="guest-logo">
            <a href="/">
                {{-- Ganti pake <img src="/logo.png" alt="Logo"> kalo mau pake gambar --}}
                <span style="font-size: 28px; font-weight: bold; color: var(--primary);">
                    One Spirit
                </span>
            </a>
        </div>

        {{-- Ini 'card' putih tempat form login/register --}}
        <div class="guest-card">
            {{-- $slot adalah tempat isi form (login.blade.php, register.blade.php) --}}
            {{ $slot }}
        </div>
    </div>
</body>
</html>
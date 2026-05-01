<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BookingElf - Rental Elf Profesional')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
        @include('layouts.partials.navbar')


    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script>
    // tunggu sampe semua halaman ke-load
    document.addEventListener("DOMContentLoaded", function() {
        
        // cari navbar-nya
        const nav = document.getElementById('main-nav');
        const hamburger = document.getElementById('nav-hamburger');
        const mobileMenu = document.getElementById('nav-mobile-menu');

        // bikin fungsi buat nge-cek scroll
        function handleScroll() {
            if (window.scrollY > 50) { 
                // kalo udah di-scroll lebih dari 50px
                nav.classList.add('scrolled');
            } else {
                // kalo balik ke paling atas
                nav.classList.remove('scrolled');
            }
        }

        // jalanin fungsinya setiap kali user nge-scroll
        window.addEventListener('scroll', handleScroll, { passive: true });

        // hamburger toggle
        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('is-open');
                mobileMenu.classList.toggle('is-open');
            });
        }
    });
</script>

</body>

</html>

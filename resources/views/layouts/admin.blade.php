<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rental Elf</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
</head>

<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="{{ route('booking.index') }}"
                    class="{{ Request::is('admin/booking*') ? 'active' : '' }}">Manajemen Booking</a></li>
            <li><a href="{{ route('mobil.index') }}" class="{{ Request::is('admin/mobil*') ? 'active' : '' }}">Manajemen
                    Mobil</a></li>
            <li><a href="{{ route('supir.index') }}" class="{{ Request::is('admin/supir*') ? 'active' : '' }}">Manajemen
                    Supir</a></li>
            <li><a href="{{ route('users.index') }}" class="{{ Request::is('admin/users*') ? 'active' : '' }}">Manajemen
                    User</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="{{ url('/') }}">← Kembali ke Homepage</a>
        </div>
    </div>

    <div class="main-content">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

</body>

</html>

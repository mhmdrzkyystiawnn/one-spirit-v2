<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Booking - {{ $mobil->nama_mobil }}</title>
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>

<body>

    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-brand">BookingElf</a>
        <div class="nav-links">
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <a href="{{ route('profile.edit') }}">Profile</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        <h1>Formulir Booking</h1>

        <!-- TEMPAT MENAMPILKAN PESAN ERROR/INFO -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="car-info">
            <h2>Anda akan memesan:</h2>
            <p><strong>{{ $mobil->nama_mobil }}</strong> ({{ $mobil->plat_nomor }})</p>
            <p>Harga akan dinegosiasikan via WhatsApp setelah booking.</p>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
            @csrf
            <input type="hidden" name="mobil_elf_id" value="{{ $mobil->id }}">

            <div class="form-group">
                <label for="tanggal_mulai_sewa">Tanggal Mulai Sewa</label>
                <input type="date" id="tanggal_mulai_sewa" name="tanggal_mulai_sewa"
                    value="{{ old('tanggal_mulai_sewa') }}" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label for="tanggal_akhir_sewa">Tanggal Akhir Sewa</label>
                <input type="date" id="tanggal_akhir_sewa" name="tanggal_akhir_sewa"
                    value="{{ old('tanggal_akhir_sewa') }}" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label for="supir_id">Pilih Supir Anda</label>
                <select id="supir_id" name="supir_id" required disabled>
                    <option value="">-- Pilih tanggal sewa terlebih dahulu --</option>
                </select>
            </div>



            <button type="submit" class="btn" id="submit-btn">Ajukan Booking Sekarang</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalMulaiInput = document.getElementById('tanggal_mulai_sewa');
            const tanggalAkhirInput = document.getElementById('tanggal_akhir_sewa');
            const supirSelect = document.getElementById('supir_id');
            const submitBtn = document.getElementById('submit-btn');
            const mobilElfId = {{ $mobil->id }};
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function validateDates() {
                const tanggalMulai = new Date(tanggalMulaiInput.value);
                const tanggalAkhir = new Date(tanggalAkhirInput.value);

                if (tanggalMulai && tanggalAkhir && tanggalAkhir >= tanggalMulai) {
                    submitBtn.disabled = false;
                    fetchAvailableDrivers();
                } else {
                    submitBtn.disabled = true;
                    supirSelect.disabled = true;
                    supirSelect.innerHTML = '<option value="">-- Pilih tanggal sewa terlebih dahulu --</option>';
                }
            }

            function fetchAvailableDrivers() {
                const tanggalMulai = tanggalMulaiInput.value;
                const tanggalAkhir = tanggalAkhirInput.value;

                if (!tanggalMulai || !tanggalAkhir) return;

                fetch('/api/available-drivers', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            mobil_elf_id: mobilElfId,
                            tanggal_mulai_sewa: tanggalMulai,
                            tanggal_akhir_sewa: tanggalAkhir
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.available) {
                            supirSelect.disabled = false;
                            supirSelect.innerHTML = '<option value="">-- Silakan Pilih Supir --</option>';
                            data.drivers.forEach(driver => {
                                const option = document.createElement('option');
                                option.value = driver.id;
                                option.textContent = driver.nama_lengkap;
                                supirSelect.appendChild(option);
                            });
                            // Clear any previous error message
                            const existingError = document.querySelector('.alert-danger');
                            if (existingError) existingError.remove();
                        } else {
                            supirSelect.disabled = true;
                            supirSelect.innerHTML = '<option value="">-- Tidak ada supir tersedia --</option>';
                            showErrorMessage(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching drivers:', error);
                        showErrorMessage('Terjadi kesalahan saat memuat data supir.');
                    });
            }

            function showErrorMessage(message) {
                // Remove existing error message
                const existingError = document.querySelector('.alert-danger');
                if (existingError) existingError.remove();

                // Create new error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger';
                errorDiv.textContent = message;

                // Insert before the form
                const container = document.querySelector('.container');
                const form = document.getElementById('booking-form');
                container.insertBefore(errorDiv, form);
            }

            tanggalMulaiInput.addEventListener('change', validateDates);
            tanggalAkhirInput.addEventListener('change', validateDates);

            // Set minimum date for end date based on start date
            tanggalMulaiInput.addEventListener('change', function() {
                tanggalAkhirInput.min = this.value;
            });

            // Initial validation if dates are pre-filled
            validateDates();
        });
    </script>

</body>

</html>

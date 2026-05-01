<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pesanan Baru Telah Masuk</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h1 style="color: #2c3e50; text-align: center;">Ada Pesanan Baru!</h1>
        <p>Halo Admin,</p>
        <p>Sebuah pesanan baru telah masuk melalui website BookingElf. Rincian harga akan didiskusikan lebih lanjut. Berikut adalah detail pesanannya:</p>
        <hr style="border: 0; border-top: 1px solid #eee;">
        <div style="padding: 10px 0;">
            <p><strong>ID Booking:</strong> #{{ $booking->id }}</p>
            <p><strong>Nama Pemesan:</strong> {{ $booking->user->name }}</p>
            <p><strong>Email Pemesan:</strong> {{ $booking->user->email }}</p>
            <p><strong>Mobil Dipesan:</strong> {{ $booking->mobilElf->nama_mobil }}</p>
            <p><strong>Tanggal Sewa:</strong> {{ $booking->tanggal_mulai_sewa }} s/d {{ $booking->tanggal_akhir_sewa }}</p>
        </div>
        <hr style="border: 0; border-top: 1px solid #eee;">
        <p style="text-align: center;">Silakan segera login ke dashboard admin untuk melihat detail dan menghubungi pelanggan.</p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('booking.index') }}" style="display: inline-block; padding: 12px 25px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Buka Dashboard Admin
            </a>
        </div>
    </div>
</body>
</html>

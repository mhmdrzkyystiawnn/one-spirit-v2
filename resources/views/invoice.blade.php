<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Invoice #{{ $booking->id }}</title>
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">BookingElf</td>
                            <td>
                                Invoice #: {{ $booking->id }}<br>
                                Dibuat: {{ $booking->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Ditagihkan kepada:</strong><br>
                                {{ $booking->user->name }}<br>
                                {{ $booking->user->email }}
                            </td>
                            <td class="status {{ strtolower($booking->status) }}">
                                {{ strtoupper($booking->status) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Deskripsi</td>
                <td>Harga</td>
            </tr>
            <tr class="item">
                <td>
                    Sewa <strong>{{ $booking->mobilElf->nama_mobil }}</strong><br>
                    Dari: {{ $booking->tanggal_mulai_sewa }}<br>
                    Sampai: {{ $booking->tanggal_akhir_sewa }}
                </td>
                <td>Harga akan dinegosiasikan via WhatsApp</td>
            </tr>
            <tr class="total">
                <td></td>
                <td><strong>Total: Harga akan dinegosiasikan via WhatsApp</strong></td>
            </tr>
        </table>

        <!-- BAGIAN BARU UNTUK PEMBAYARAN -->
        @if ($booking->status == 'pending')
            <div class="payment-instructions">
                <h3>Instruksi Pembayaran</h3>
                <p>Status pesanan Anda saat ini adalah <strong>Pending</strong>. Untuk menyelesaikan pesanan dan mendapatkan konfirmasi, silakan lanjutkan pembayaran dengan menghubungi admin melalui WhatsApp.</p>
                @php
                    $adminWhatsapp = env('ADMIN_WHATSAPP_NUMBER');
                    $pesan = "Halo admin, saya ingin melakukan pembayaran untuk Invoice #{$booking->id} atas nama {$booking->user->name}.";
                @endphp
                <a href="https://wa.me/{{ $adminWhatsapp }}?text={{ urlencode($pesan) }}" class="btn-whatsapp-pay" target="_blank">Hubungi Admin untuk Bayar</a>
            </div>
        @endif

        <div class="no-print">
            <button class="print-button" onclick="window.print()">Cetak Invoice</button>
        </div>
    </div>
</body>
</html>
    


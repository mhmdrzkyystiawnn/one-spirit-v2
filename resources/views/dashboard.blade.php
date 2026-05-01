@extends('layouts.app')

@section('title', 'Riwayat Booking - One Spirit')

@section('content')

{{-- ===== PAGE HERO ===== --}}
<div class="booking-hero" data-aos="fade-up">
    <div class="booking-hero-inner">
        <span class="section-label">Akun Saya</span>
        <h1 class="booking-hero-title">Riwayat Booking</h1>
        <p class="booking-hero-sub">Pantau status pesanan, lihat invoice, atau hubungi admin langsung dari sini.</p>
    </div>
</div>

{{-- ===== BODY ===== --}}
<div class="booking-body">

    @if (session('success'))
        <div class="alert-success alert-dismissible" data-aos="fade-down">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if ($daftar_booking->isEmpty())
        {{-- Empty state --}}
        <div class="booking-empty" data-aos="fade-up">
            <div class="booking-empty-icon">
                <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                    <line x1="9" y1="15" x2="15" y2="15"/>
                </svg>
            </div>
            <h3>Belum Ada Booking</h3>
            <p>Anda belum pernah melakukan booking. Temukan armada terbaik dan mulai perjalanan Anda!</p>
            <a href="{{ route('mobil.katalog') }}" class="detail-book-btn" style="display:inline-flex;width:auto;margin:0;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                </svg>
                Cari Armada Sekarang
            </a>
        </div>

    @else
        {{-- Stats row --}}
        <div class="booking-stats" data-aos="fade-up">
            @php
                $total      = $daftar_booking->count();
                $completed  = $daftar_booking->where('status', 'completed')->count();
                $pending    = $daftar_booking->whereIn('status', ['pending', 'confirmed'])->count();
                $cancelled  = $daftar_booking->where('status', 'cancelled')->count();
            @endphp
            <div class="booking-stat-item">
                <strong>{{ $total }}</strong>
                <span>Total Booking</span>
            </div>
            <div class="booking-stat-div"></div>
            <div class="booking-stat-item">
                <strong class="text-success">{{ $completed }}</strong>
                <span>Selesai</span>
            </div>
            <div class="booking-stat-div"></div>
            <div class="booking-stat-item">
                <strong class="text-pending">{{ $pending }}</strong>
                <span>Aktif</span>
            </div>
            <div class="booking-stat-div"></div>
            <div class="booking-stat-item">
                <strong class="text-danger">{{ $cancelled }}</strong>
                <span>Dibatalkan</span>
            </div>
        </div>

        {{-- Booking cards --}}
        <div class="booking-list">
            @foreach ($daftar_booking as $booking)
                <div class="booking-card" data-aos="fade-up" data-aos-delay="{{ min($loop->index * 70, 400) }}">

                    {{-- Card header --}}
                    <div class="booking-card-header">
                        <div class="booking-card-id">
                            <span class="booking-id-label">Booking</span>
                            <span class="booking-id-val">#{{ $booking->id }}</span>
                        </div>
                        <div class="booking-status-badge status-badge--{{ $booking->status }}">
                            @php
                                $statusIcons = [
                                    'pending'   => '<circle cx="12" cy="12" r="4" fill="currentColor"/>',
                                    'confirmed' => '<polyline points="20 6 9 17 4 12"/>',
                                    'completed' => '<polyline points="20 6 9 17 4 12"/><line x1="4" y1="20" x2="20" y2="20"/>',
                                    'cancelled' => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
                                ];
                                $icon = $statusIcons[$booking->status] ?? '<circle cx="12" cy="12" r="4"/>';
                                $labels = [
                                    'pending'   => 'Menunggu',
                                    'confirmed' => 'Dikonfirmasi',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                {!! $icon !!}
                            </svg>
                            {{ $labels[$booking->status] ?? ucfirst($booking->status) }}
                        </div>
                    </div>

                    {{-- Card body --}}
                    <div class="booking-card-body">
                        <div class="booking-car-info">
                            <div class="booking-car-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <rect x="1" y="9" width="22" height="10" rx="2"/>
                                    <path d="M5 9V6a2 2 0 014 0v3M15 9V6a2 2 0 014 0v3"/>
                                    <circle cx="7.5" cy="18.5" r="1.5" fill="currentColor"/>
                                    <circle cx="16.5" cy="18.5" r="1.5" fill="currentColor"/>
                                </svg>
                            </div>
                            <div>
                                <p class="booking-car-name">{{ $booking->mobilElf->nama_mobil }}</p>
                                <p class="booking-car-sub">Armada One Spirit</p>
                            </div>
                        </div>

                        <div class="booking-card-meta">
                            <div class="booking-meta-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                <span>
                                    {{ \Carbon\Carbon::parse($booking->tanggal_mulai_sewa)->translatedFormat('d M Y') }}
                                    <span class="meta-sep">→</span>
                                    {{ \Carbon\Carbon::parse($booking->tanggal_akhir_sewa)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            <div class="booking-meta-item">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23"/>
                                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                                </svg>
                                <span>Harga dikonfirmasi via WhatsApp</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card actions --}}
                    <div class="booking-card-actions">
                        @if ($booking->status == 'completed' && !$booking->review)
                            <a href="{{ route('review.create', $booking->id) }}" class="booking-action-btn booking-action-btn--review">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                Beri Ulasan
                            </a>
                        @endif

                        @if ($booking->status != 'cancelled')
                            <a href="{{ route('invoice.show', $booking->id) }}" target="_blank" class="booking-action-btn booking-action-btn--invoice">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10 9 9 9 8 9"/>
                                </svg>
                                Invoice & Bayar
                            </a>
                        @endif

                        @php
                            $pesan = "Halo admin, saya mau bertanya mengenai pesanan saya dengan ID Booking: #{$booking->id}";
                        @endphp
                        <a href="https://wa.me/{{ $admin_whatsapp }}?text={{ urlencode($pesan) }}"
                           target="_blank"
                           class="booking-action-btn booking-action-btn--wa">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.859L.057 23.8l6.102-1.463A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.885 0-3.652-.51-5.17-1.395l-.37-.22-3.623.869.898-3.538-.242-.384A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                            </svg>
                            Tanya Admin
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

@endsection
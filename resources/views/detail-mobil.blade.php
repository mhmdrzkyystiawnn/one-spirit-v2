@extends('layouts.app')

@section('title', '{{ $mobil->nama_mobil }} - One Spirit')

@section('content')

{{-- ===== HERO IMAGE ===== --}}
<div class="detail-hero" data-aos="fade-up">
    <img src="{{ asset('storage/' . $mobil->foto_mobil) }}" alt="Foto {{ $mobil->nama_mobil }}" class="detail-hero-img">
    <div class="detail-hero-overlay">
        <div class="detail-hero-inner">
            <a href="{{ route('mobil.katalog') }}" class="detail-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                </svg>
                Kembali ke Katalog
            </a>
            <h1 class="detail-hero-title">{{ $mobil->nama_mobil }}</h1>
            @php $avgRating = $mobil->reviews->avg('rating'); @endphp
            @if ($avgRating)
                <div class="detail-hero-rating">
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= round($avgRating) ? 'star-filled' : 'star-empty' }}">★</span>
                        @endfor
                    </div>
                    <span>{{ number_format($avgRating, 1) }} · {{ $mobil->reviews->count() }} ulasan</span>
                </div>
            @else
                <div class="detail-hero-rating">
                    <span class="detail-no-review">Belum ada ulasan</span>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ===== BODY ===== --}}
<div class="detail-body">
    <div class="detail-main">

        {{-- Specs --}}
        <div class="detail-card" data-aos="fade-up">
            <h2 class="detail-card-title">Spesifikasi Armada</h2>
            <div class="detail-specs-grid">
                <div class="detail-spec-item">
                    <div class="detail-spec-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <div>
                        <span class="detail-spec-label">Kapasitas</span>
                        <strong class="detail-spec-val">{{ $mobil->kapasitas_penumpang }} Orang</strong>
                    </div>
                </div>
                <div class="detail-spec-item">
                    <div class="detail-spec-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
                        </svg>
                    </div>
                    <div>
                        <span class="detail-spec-label">Transmisi</span>
                        <strong class="detail-spec-val">{{ ucfirst($mobil->transmisi) }}</strong>
                    </div>
                </div>
                <div class="detail-spec-item">
                    <div class="detail-spec-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                            <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                            <line x1="12" y1="12" x2="12" y2="16"/>
                            <line x1="10" y1="14" x2="14" y2="14"/>
                        </svg>
                    </div>
                    <div>
                        <span class="detail-spec-label">Plat Nomor</span>
                        <strong class="detail-spec-val">{{ $mobil->plat_nomor }}</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="detail-card" data-aos="fade-up" data-aos-delay="100">
            <h2 class="detail-card-title">Tentang Armada Ini</h2>
            <p class="detail-desc">{{ $mobil->deskripsi ?? 'Deskripsi lengkap belum tersedia untuk armada ini.' }}</p>
        </div>

        {{-- Keunggulan --}}
        <div class="detail-card detail-card--accent" data-aos="fade-up" data-aos-delay="150">
            <div class="detail-perks">
                <div class="detail-perk">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Supir profesional & berpengalaman
                </div>
                <div class="detail-perk">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Armada terawat, bersih & siap jalan
                </div>
                <div class="detail-perk">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Harga transparan, bisa negosiasi via WhatsApp
                </div>
            </div>
        </div>

        {{-- Reviews --}}
        <div class="detail-card" data-aos="fade-up" data-aos-delay="200">
            <div class="detail-reviews-header">
                <h2 class="detail-card-title" style="margin:0">Ulasan Pelanggan</h2>
                @if ($avgRating)
                    <div class="detail-reviews-avg">
                        <strong>{{ number_format($avgRating, 1) }}</strong>
                        <div class="star-rating" style="font-size:13px;">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= round($avgRating) ? 'star-filled' : 'star-empty' }}">★</span>
                            @endfor
                        </div>
                        <span>{{ $mobil->reviews->count() }} ulasan</span>
                    </div>
                @endif
            </div>

            <div class="detail-reviews-list">
                @forelse ($mobil->reviews as $review)
                    <div class="review-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="review-card-top">
                            <div class="review-avatar">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div class="review-meta">
                                <strong>{{ $review->user->name }}</strong>
                                <div class="star-rating" style="font-size:13px;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $review->rating ? 'star-filled' : 'star-empty' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="review-comment">"{{ $review->komentar }}"</p>
                    </div>
                @empty
                    <div class="detail-empty-review">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                        </svg>
                        <p>Jadilah yang pertama memberikan ulasan untuk armada ini!</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ===== STICKY SIDEBAR ===== --}}
    <div class="detail-sidebar">
        <div class="detail-sidebar-card" data-aos="fade-left" data-aos-delay="200">
            <div class="detail-sidebar-top">
                <p class="detail-sidebar-label">Tertarik dengan armada ini?</p>
                <h3 class="detail-sidebar-name">{{ $mobil->nama_mobil }}</h3>
                @if ($avgRating)
                    <div class="detail-sidebar-rating">
                        <span class="star-filled" style="font-size:15px;">★</span>
                        <strong>{{ number_format($avgRating, 1) }}</strong>
                        <span>({{ $mobil->reviews->count() }} ulasan)</span>
                    </div>
                @endif
            </div>

            <div class="detail-sidebar-specs">
                <div class="detail-sidebar-spec">
                    <span>Kapasitas</span>
                    <strong>{{ $mobil->kapasitas_penumpang }} Orang</strong>
                </div>
                <div class="detail-sidebar-spec">
                    <span>Transmisi</span>
                    <strong>{{ ucfirst($mobil->transmisi) }}</strong>
                </div>
                <div class="detail-sidebar-spec">
                    <span>Plat Nomor</span>
                    <strong>{{ $mobil->plat_nomor }}</strong>
                </div>
            </div>

            <a href="{{ route('booking.form', $mobil->id) }}" class="detail-book-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                Booking Sekarang
            </a>

            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20menyewa%20{{ urlencode($mobil->nama_mobil) }}"
               target="_blank" class="detail-wa-btn">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.859L.057 23.8l6.102-1.463A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.885 0-3.652-.51-5.17-1.395l-.37-.22-3.623.869.898-3.538-.242-.384A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                </svg>
                Tanya via WhatsApp
            </a>

            <p class="detail-sidebar-note">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                Harga final dikonfirmasi via WhatsApp setelah booking.
            </p>
        </div>
    </div>
</div>

@endsection
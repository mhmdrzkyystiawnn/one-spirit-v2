@extends('layouts.app')

@section('title', 'Katalog Armada - One Spirit')

@section('content')

{{-- ===== PAGE HERO ===== --}}
<div class="katalog-hero" data-aos="fade-up">
    <div class="katalog-hero-inner">
        <span class="section-label" data-aos="fade-up" data-aos-delay="100">Temukan Armada Ideal Anda</span>
        <h1 class="katalog-hero-title" data-aos="fade-up" data-aos-delay="200">Katalog Armada Kami</h1>

        @if (request('tanggal_mulai'))
            <div class="katalog-search-info" data-aos="fade-up" data-aos-delay="300">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                Menampilkan armada tersedia:
                <strong>{{ \Carbon\Carbon::parse(request('tanggal_mulai'))->translatedFormat('d M Y') }}</strong>
                <span class="katalog-date-sep">→</span>
                <strong>{{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d M Y') }}</strong>
                <a href="{{ route('mobil.katalog') }}" class="katalog-reset">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    Reset
                </a>
            </div>
        @else
            <p class="katalog-hero-sub" data-aos="fade-up" data-aos-delay="300">
                Pilih armada terbaik untuk perjalanan rombongan Anda. Semua unit terawat dan siap berangkat.
            </p>
        @endif
    </div>
</div>

{{-- ===== GRID ===== --}}
<div class="katalog-body" data-aos="fade-up" data-aos-delay="200">
    <div class="car-grid">
        @forelse ($daftar_mobil as $mobil)
            <div class="car-card" data-aos="fade-up" data-aos-delay="{{ min($loop->index * 80 + 100, 500) }}">

                {{-- Gambar --}}
                <div class="car-card-img-wrap">
                    <img src="{{ asset('storage/' . $mobil->foto_mobil) }}" alt="Foto {{ $mobil->nama_mobil }}">

                    @if ($mobil->reviews_avg_rating)
                        <div class="car-card-badge">
                            ★ {{ number_format($mobil->reviews_avg_rating, 1) }}
                        </div>
                    @endif

                    <div class="car-card-overlay">
                        <a href="{{ route('mobil.detail', $mobil->id) }}" class="car-card-overlay-btn">
                            Lihat Detail
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Konten --}}
                <div class="car-card-content">
                    <h3>{{ $mobil->nama_mobil }}</h3>

                    {{-- Rating --}}
                    @if ($mobil->reviews_avg_rating)
                        <div class="car-card-rating">
                            <div class="star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= round($mobil->reviews_avg_rating) ? 'star-filled' : 'star-empty' }}">★</span>
                                @endfor
                            </div>
                            <span class="car-card-rating-text">
                                {{ number_format($mobil->reviews_avg_rating, 1) }}
                                <span>({{ $mobil->reviews->count() }} ulasan)</span>
                            </span>
                        </div>
                    @else
                        <div class="car-card-no-review">Belum ada ulasan</div>
                    @endif

                    {{-- Spesifikasi --}}
                    <div class="car-card-specs">
                        <div class="car-spec-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                                <path d="M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                            {{ $mobil->kapasitas_penumpang }} Penumpang
                        </div>
                        <div class="car-spec-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/>
                            </svg>
                            {{ ucfirst($mobil->transmisi) }}
                        </div>
                    </div>

                    {{-- Snippet review terbaru --}}
                    @if ($mobil->reviews->isNotEmpty())
                        <div class="car-card-review-snippet">
                            <div class="car-card-review-quote">"</div>
                            <p>{{ Str::limit($mobil->reviews->first()->komentar, 90) }}</p>
                            <span>— {{ $mobil->reviews->first()->user->name }}</span>
                        </div>
                    @endif

                    <a href="{{ route('mobil.detail', $mobil->id) }}" class="car-card-btn">
                        Lihat Detail & Pesan
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

        @empty
            <div class="katalog-empty" style="grid-column: 1 / -1;">
                <div class="katalog-empty-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                        <rect x="1" y="9" width="22" height="10" rx="2"/>
                        <path d="M5 9V6a2 2 0 014 0v3M15 9V6a2 2 0 014 0v3"/>
                        <circle cx="7.5" cy="18.5" r="1.5" fill="currentColor"/>
                        <circle cx="16.5" cy="18.5" r="1.5" fill="currentColor"/>
                    </svg>
                </div>
                @if (request('tanggal_mulai'))
                    <h3>Tidak Ada Armada Tersedia</h3>
                    <p>Mohon maaf, tidak ada armada yang tersedia untuk tanggal yang dipilih. Coba ubah rentang tanggal Anda.</p>
                    <a href="{{ route('mobil.katalog') }}" class="btn-outline" style="display:inline-flex;margin-top:8px;">
                        Lihat Semua Armada
                    </a>
                @else
                    <h3>Belum Ada Armada</h3>
                    <p>Saat ini belum ada armada yang tersedia. Silakan cek kembali beberapa saat lagi.</p>
                @endif
            </div>
        @endforelse
    </div>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Beranda - One Spirit')

@section('content')

{{-- ===== HERO ===== --}}
<div class="hero" data-aos="fade-up">
    <div class="hero-eyebrow" data-aos="fade-up" data-aos-delay="100">
        <span class="hero-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
            Armada Siap Berangkat
        </span>
    </div>
    <div class="hero-content">
        <h1 data-aos="fade-up" data-aos-delay="200">
            Perjalanan Rombongan<br>
            <span class="hero-highlight">Jadi Mudah & Nyaman</span>
        </h1>
        <p data-aos="fade-up" data-aos-delay="400">
            Sewa mobil elf dengan supir profesional untuk segala kebutuhan wisatamu.<br>
            Cek ketersediaan armada kami di bawah ini.
        </p>

        <form action="{{ route('mobil.katalog') }}" method="GET" class="search-form" data-aos="fade-up" data-aos-delay="600">
            <div class="search-form-inner">
                <div class="form-group">
                    <label for="tanggal_mulai">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Tanggal Mulai
                    </label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" required>
                </div>
                <div class="search-divider"></div>
                <div class="form-group">
                    <label for="tanggal_akhir">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Tanggal Selesai
                    </label>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" required>
                </div>
                <button type="submit" class="cta-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Cari Mobil
                </button>
            </div>
        </form>

        <div class="hero-stats" data-aos="fade-up" data-aos-delay="800">
            <div class="hero-stat">
                <strong>50+</strong>
                <span>Armada Aktif</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <strong>1000+</strong>
                <span>Perjalanan Selesai</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <strong>4.9★</strong>
                <span>Rating Rata-rata</span>
            </div>
        </div>
    </div>
</div>

{{-- ===== ARMADA UNGGULAN ===== --}}
<div class="section section--light" data-aos="fade-up">
    <div class="section-header" data-aos="fade-up" data-aos-delay="100">
        <p class="section-label">Pilihan Terbaik</p>
        <h2 class="section-title">Armada Unggulan Kami</h2>
        <p class="section-subtitle">Dipilih berdasarkan ulasan terbaik dari pelanggan setia kami</p>
    </div>

    <div class="featured-cars">
        @forelse ($mobil_unggulan as $mobil)
            <a href="{{ route('mobil.detail', $mobil->id) }}" class="car-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 200 }}">
                <div class="car-card-img-wrap">
                    <img src="{{ asset('storage/' . $mobil->foto_mobil) }}" alt="Foto {{ $mobil->nama_mobil }}">
                    @if ($mobil->reviews_avg_rating)
                        <div class="car-card-badge">
                            ★ {{ number_format($mobil->reviews_avg_rating, 1) }}
                        </div>
                    @endif
                </div>
                <div class="car-card-content">
                    <h3>{{ $mobil->nama_mobil }}</h3>
                    @if ($mobil->reviews_avg_rating)
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= round($mobil->reviews_avg_rating) ? 'star-filled' : 'star-empty' }}">★</span>
                            @endfor
                            <small>({{ $mobil->reviews_count ?? '' }} ulasan)</small>
                        </div>
                    @endif
                    <span class="car-card-cta">Lihat Detail →</span>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">🚗</div>
                <p>Belum ada armada unggulan untuk ditampilkan.</p>
            </div>
        @endforelse
    </div>

    <div class="section-action" data-aos="fade-up">
        <a href="{{ route('mobil.katalog') }}" class="btn-outline">
            Lihat Semua Armada
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>
</div>

{{-- ===== KENAPA KAMI ===== --}}
<div class="section section--accent" data-aos="fade-up">
    <div class="section-header" data-aos="fade-up" data-aos-delay="100">
        <p class="section-label section-label--light">Keunggulan Kami</p>
        <h2 class="section-title section-title--light">Kenapa Memilih Kami?</h2>
    </div>

    <div class="why-us-grid">
        <div class="why-us-item" data-aos="fade-up" data-aos-delay="200">
            <div class="why-us-icon-wrap">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </div>
            <h3>Supir Profesional</h3>
            <p>Semua supir kami berpengalaman, ramah, dan hafal rute terbaik untuk mengantar Anda dengan aman.</p>
        </div>
        <div class="why-us-item" data-aos="fade-up" data-aos-delay="300">
            <div class="why-us-icon-wrap why-us-icon-wrap--featured">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="9" width="22" height="10" rx="2"/><path d="M5 9V6a3 3 0 016 0v3"/><path d="M13 9V6a3 3 0 016 0v3"/></svg>
            </div>
            <h3>Armada Terawat</h3>
            <p>Armada kami selalu dalam kondisi prima, bersih, dan nyaman untuk setiap perjalanan rombongan Anda.</p>
        </div>
        <div class="why-us-item" data-aos="fade-up" data-aos-delay="400">
            <div class="why-us-icon-wrap">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
            </div>
            <h3>Harga Nego</h3>
            <p>Dapatkan harga terbaik sesuai kebutuhan melalui diskusi langsung via WhatsApp, cepat dan transparan.</p>
        </div>
    </div>
</div>

{{-- ===== TESTIMONI ===== --}}
<div class="section section--light" data-aos="fade-up">
    <div class="section-header" data-aos="fade-up" data-aos-delay="100">
        <p class="section-label">Ulasan Pelanggan</p>
        <h2 class="section-title">Apa Kata Mereka?</h2>
        <p class="section-subtitle">Pengalaman nyata dari pelanggan yang telah mempercayai kami</p>
    </div>

    <div class="testimonials">
        @forelse ($review_terbaru as $review)
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 120 + 200 }}">
                <div class="testimonial-quote-icon">"</div>
                <p class="testimonial-text">{{ $review->komentar }}</p>
                <div class="testimonial-footer">
                    <div class="testimonial-avatar">
                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                    </div>
                    <div class="testimonial-author">
                        <strong>{{ $review->user->name }}</strong>
                        <span>Menyewa {{ $review->mobilElf->nama_mobil }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" style="grid-column: 1/-1;">
                <div class="empty-state-icon">💬</div>
                <p>Jadilah yang pertama memberikan ulasan!</p>
            </div>
        @endforelse
    </div>
</div>

{{-- ===== CTA STRIP ===== --}}
<div class="cta-strip" data-aos="fade-up">
    <div class="cta-strip-content">
        <h2>Siap Merencanakan Perjalanan?</h2>
        <p>Hubungi kami sekarang dan dapatkan penawaran terbaik untuk rombongan Anda.</p>
    </div>
    <a href="https://wa.me/6281234567890" target="_blank" class="cta-strip-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.859L.057 23.8l6.102-1.463A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.885 0-3.652-.51-5.17-1.395l-.37-.22-3.623.869.898-3.538-.242-.384A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
        Chat WhatsApp
    </a>
</div>

@endsection
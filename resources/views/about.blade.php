@extends('layouts.app')

@section('title', 'Tentang Kami - One Spirit')

@section('content')

{{-- ===== HERO ABOUT ===== --}}
<div class="about-hero" data-aos="fade-up">
    <div class="about-hero-inner">
        <span class="section-label" data-aos="fade-up" data-aos-delay="100">Kenali Kami Lebih Dekat</span>
        <h1 class="about-hero-title" data-aos="fade-up" data-aos-delay="200">
            Bukan Sekadar Sewa Mobil.<br>
            <span class="about-hero-highlight">Kami Adalah Mitra Perjalanan Anda.</span>
        </h1>

        <div class="typed-headlines" data-aos="fade-up" data-aos-delay="300">
            <div class="typed-subtitle-wrap">
                <span id="typed-subheadline"></span>
            </div>
        </div>

        <div class="about-hero-desc" data-aos="fade-up" data-aos-delay="400">
            <p>Kami adalah mitra profesional untuk solusi transportasi rombongan premium — hadir dengan
                <strong>kenyamanan</strong>, <strong>keamanan</strong>, dan <strong>pelayanan tertinggi</strong>
                sebagai janji utama kami.
            </p>
            <p>Dengan armada Isuzu Elf terawat dan pengemudi berpengalaman, kami mengubah setiap kilometer
                perjalanan menjadi pengalaman yang berkesan.</p>
        </div>

        <div class="about-hero-stats" data-aos="fade-up" data-aos-delay="500">
            <div class="about-stat">
                <strong>10+</strong>
                <span>Tahun Pengalaman</span>
            </div>
            <div class="about-stat-div"></div>
            <div class="about-stat">
                <strong>50+</strong>
                <span>Unit Armada</span>
            </div>
            <div class="about-stat-div"></div>
            <div class="about-stat">
                <strong>1000+</strong>
                <span>Pelanggan Puas</span>
            </div>
            <div class="about-stat-div"></div>
            <div class="about-stat">
                <strong>4.9★</strong>
                <span>Rating Layanan</span>
            </div>
        </div>
    </div>
</div>

{{-- ===== VISI ===== --}}
<div class="section section--light" data-aos="fade-up">
    <div class="section-header">
        <span class="section-label" data-aos="fade-up" data-aos-delay="100">Arah Kami</span>
        <h2 class="section-title" data-aos="fade-up" data-aos-delay="150">Visi Kami</h2>
    </div>

    <div class="vision-card" data-aos="fade-up" data-aos-delay="200">
        <div class="vision-card-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="12" r="10"/>
                <circle cx="12" cy="12" r="3"/>
                <line x1="12" y1="2" x2="12" y2="5"/>
                <line x1="12" y1="19" x2="12" y2="22"/>
                <line x1="2" y1="12" x2="5" y2="12"/>
                <line x1="19" y1="12" x2="22" y2="12"/>
            </svg>
        </div>
        <div class="vision-card-body">
            <h3>Menjadi Standar Emas Transportasi Indonesia</h3>
            <p>Menjadi <em>benchmark</em> dalam industri transportasi dan sewa armada di Indonesia — diakui
                secara nasional sebagai mitra terpercaya yang identik dengan kualitas tanpa kompromi,
                profesionalisme tim, dan kepuasan total pelanggan di setiap perjalanan.</p>
        </div>
        <div class="vision-card-accent"></div>
    </div>
</div>

{{-- ===== MISI ===== --}}
<div class="section section--accent" data-aos="fade-up">
    <div class="section-header">
        <span class="section-label section-label--light" data-aos="fade-up" data-aos-delay="100">Cara Kami Bekerja</span>
        <h2 class="section-title section-title--light" data-aos="fade-up" data-aos-delay="150">Misi Kami</h2>
    </div>

    <div class="misi-grid">
        <div class="misi-item" data-aos="fade-up" data-aos-delay="200">
            <div class="misi-number">01</div>
            <div class="misi-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="1" y="9" width="22" height="10" rx="2"/>
                    <path d="M5 9V6a2 2 0 014 0v3M15 9V6a2 2 0 014 0v3"/>
                    <circle cx="12" cy="14" r="1.5" fill="currentColor"/>
                </svg>
            </div>
            <h3>Armada Berkualitas Prima</h3>
            <p>Kelaikan jalan 100% melalui SOP perawatan preventif, inspeksi menyeluruh sebelum keberangkatan,
                dan kebersihan interior yang terjaga di setiap unit armada kami.</p>
        </div>

        <div class="misi-item" data-aos="fade-up" data-aos-delay="300">
            <div class="misi-number">02</div>
            <div class="misi-icon misi-icon--featured">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    <polyline points="16 11 18 13 22 9"/>
                </svg>
            </div>
            <h3>Pengemudi Profesional & Beretika</h3>
            <p>Pengemudi kami bukan hanya mahir berkendara, tetapi juga terlatih dalam etika pelayanan,
                kedisiplinan waktu, dan prinsip <em>safety driving</em> yang ketat.</p>
        </div>

        <div class="misi-item" data-aos="fade-up" data-aos-delay="400">
            <div class="misi-number">03</div>
            <div class="misi-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                </svg>
            </div>
            <h3>Pelayanan Responsif & Transparan</h3>
            <p>Komunikasi proaktif, proses booking tanpa biaya tersembunyi, dan setiap klien dipastikan
                merasa didengar serta menjadi prioritas utama tim kami.</p>
        </div>
    </div>
</div>

{{-- ===== KONTAK ===== --}}
<div class="section section--light" data-aos="fade-up">
    <div class="section-header">
        <span class="section-label" data-aos="fade-up" data-aos-delay="100">Hubungi Kami</span>
        <h2 class="section-title" data-aos="fade-up" data-aos-delay="150">Mulai Rencanakan Perjalanan Anda</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
            Tim kami siap membantu untuk kebutuhan korporat, wisata, maupun acara khusus.
        </p>
    </div>

    <div class="contact-grid" data-aos="fade-up" data-aos-delay="250">
        <a href="https://wa.me/6281234567890" target="_blank" class="contact-card contact-card--whatsapp">
            <div class="contact-card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.859L.057 23.8l6.102-1.463A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.885 0-3.652-.51-5.17-1.395l-.37-.22-3.623.869.898-3.538-.242-.384A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                </svg>
            </div>
            <div class="contact-card-body">
                <h3>WhatsApp / Telepon</h3>
                <p>+62 812-3456-7890</p>
                <span class="contact-card-action">Chat Sekarang →</span>
            </div>
        </a>

        <a href="mailto:info@onespirit.com" class="contact-card">
            <div class="contact-card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </div>
            <div class="contact-card-body">
                <h3>Email</h3>
                <p>info@onespirit.com</p>
                <span class="contact-card-action">Kirim Email →</span>
            </div>
        </a>

        <div class="contact-card">
            <div class="contact-card-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
            </div>
            <div class="contact-card-body">
                <h3>Kantor Pusat</h3>
                <p>Jl. Raya Wisata No. 123, Jakarta</p>
                <span class="contact-card-action">Lihat Maps →</span>
            </div>
        </div>
    </div>

    {{-- CTA strip --}}
    <div class="about-cta" data-aos="fade-up" data-aos-delay="400">
        <h3>Siap berangkat bersama kami?</h3>
        <p>Konsultasikan kebutuhan perjalanan Anda sekarang — gratis, tanpa komitmen.</p>
        <div class="about-cta-actions">
            <a href="{{ route('mobil.katalog') }}" class="btn-outline">
                Lihat Katalog Armada
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <a href="https://wa.me/6281234567890" target="_blank" class="cta-strip-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.859L.057 23.8l6.102-1.463A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.885 0-3.652-.51-5.17-1.395l-.37-.22-3.623.869.898-3.538-.242-.384A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                Mulai Konsultasi
            </a>
        </div>
    </div>
</div>

@endsection
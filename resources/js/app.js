import './bootstrap';

import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Typed from 'typed.js';

window.Alpine = Alpine;
Alpine.start();

// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false
});

// Initialize Typed.js for About page
// Inisialisasi Typed.js (BARU)
document.addEventListener('DOMContentLoaded', function () {
    
    // 1. Typed.js untuk Headline Utama
    const headlineElement = document.querySelector('#typed-headline');
    if (headlineElement) {
        new Typed('#typed-headline', {
            strings: ['Mitra Perjalanan Profesional Anda.'], // Cuma 1 kalimat
            typeSpeed: 40,  // Lebih cepet dikit
            startDelay: 500,
            showCursor: false, // Ngga usah pake cursor
            loop: false
        });
    }

    // 2. Typed.js untuk Sub-headline (Ganti-ganti)
    const subheadlineElement = document.querySelector('#typed-subheadline');
    if (subheadlineElement) {
        new Typed('#typed-subheadline', {
            strings: [
                'Kenyamanan Anda Prioritas Kami.',
                'Armada Prima, Supir Profesional.',
                'Perjalanan Aman & Berkesan.',
                'Solusi Transportasi Rombongan Terbaik.',
                'Harga Kompetitif, Pelayanan Maksimal.'
            ],
            typeSpeed: 30,
            backSpeed: 20,
            backDelay: 2500, // Jeda sebelum hapus
            startDelay: 1500, // Mulai setelah headline selesai
            loop: true,       // Biar ngulang terus
            showCursor: true,
            cursorChar: '_', // Ganti cursor jadi underscore
            smartBackspace: false // Hapus semua biar ganti total
        });
    }
});

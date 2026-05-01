<footer class="footer">
    <div class="footer-grid">
        <div class="footer-col">
            <h4>BookingElf</h4>
            <p style="font-size: 14px; line-height: 1.6;">Solusi perjalanan rombongan Anda dengan armada elf terbaik dan supir profesional.</p>
        </div>
        <div class="footer-col">
            <h4>Navigasi</h4>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('mobil.katalog') }}">Armada</a>
            <a href="#">FAQ</a>
        </div>
        <div class="footer-col">
            <h4>Hubungi Kami</h4>
            <a href="#">WhatsApp</a>
            <a href="#">Instagram</a>
            <a href="#">Email</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} BookingElf. All Rights Reserved.</p>
    </div>
</footer>

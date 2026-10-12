# One Spirit V2

One Spirit V2 adalah aplikasi web pemesanan travel/mobil ELF berbasis Laravel. Aplikasi ini menyediakan alur booking dari katalog mobil sampai invoice, dilengkapi dashboard user, review pelanggan, serta panel admin untuk manajemen data operasional.

## Fitur Utama

### User
- Melihat halaman home, about, testimonials, katalog mobil, dan detail mobil.
- Filter ketersediaan mobil berdasarkan tanggal sewa.
- Booking mobil + supir dengan validasi bentrok jadwal mobil/supir.
- Melihat dashboard riwayat booking dan invoice.
- Memberikan review setelah booking.
- Mengelola profil akun (Laravel Breeze).

### Admin
- Manajemen data mobil (`/admin/mobil`).
- Manajemen data supir (`/admin/supir`).
- Manajemen data user (`/admin/users`).
- Manajemen data booking (`/admin/booking`), termasuk update status booking, supir, dan mobil.
- Notifikasi email saat booking baru masuk.

## Tech Stack
- **Backend:** PHP 8.2, Laravel 12
- **Frontend:** Blade, Vite, Tailwind CSS, Alpine.js
- **UI/Animation:** AOS, Typed.js
- **Database:** MySQL
- **Auth:** Laravel Breeze
- **Testing:** Pest / PHPUnit

## Struktur Entitas Inti
- **users**: data akun + role (`admin` / `user`)
- **mobil_elf**: data armada dan status (`tersedia`, `dipesan`, `perbaikan`)
- **supir**: data supir dan status (`tersedia`, `bertugas`, `libur`)
- **bookings**: transaksi booking dengan status (`pending`, `confirmed`, `completed`, `cancelled`)
- **reviews**: ulasan user per booking (1 booking = 1 review)

## Prasyarat
- PHP 8.2+
- Composer
- Node.js + npm
- MySQL

## Instalasi & Setup

1. Install dependency PHP:
   ```bash
   composer install
   ```
2. Install dependency frontend:
   ```bash
   npm install
   ```
3. Salin env:
   ```bash
   cp .env.example .env
   ```
4. Generate app key:
   ```bash
   php artisan key:generate
   ```
5. Atur konfigurasi database di `.env`:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=bookingmobilelf`
   - `DB_USERNAME=...`
   - `DB_PASSWORD=...`
6. Jalankan migrasi + seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```
7. Build asset:
   ```bash
   npm run build
   ```

> Alternatif setup cepat tersedia via script Composer:
> ```bash
> composer run setup
> ```

## Menjalankan Aplikasi

### Mode development (server + queue + vite)
```bash
composer run dev
```

### Menjalankan komponen terpisah
```bash
php artisan serve
php artisan queue:listen --tries=1
npm run dev
```

## Testing
```bash
composer run test
```

## Akun Seed Default
- **Admin**
  - Email: `admin@onespirit.com`
  - Password: `admin123`

## Konfigurasi Tambahan
- `ADMIN_WHATSAPP_NUMBER` digunakan di dashboard user untuk tombol kontak admin.
- Email notifikasi booking baru dikirim ke `admin@bookingelf.com` (lihat `HomeController@storeBooking`).

## Rute Penting
- Public: `/`, `/about`, `/testimonials`, `/mobil`, `/mobil/{mobil}`
- Booking: `/booking/{mobil}`, `/booking`, `/invoice/{booking}`
- User: `/dashboard`, `/profile`
- Admin: `/admin/mobil`, `/admin/supir`, `/admin/users`, `/admin/booking`

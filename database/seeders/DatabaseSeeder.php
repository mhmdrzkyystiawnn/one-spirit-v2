<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MobilElf;
use App\Models\Supir;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks untuk truncate
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables untuk fresh seed
        \DB::table('reviews')->truncate();
        \DB::table('bookings')->truncate();
        \DB::table('supir')->truncate();
        \DB::table('mobil_elf')->truncate();
        \DB::table('users')->truncate();

        // Enable foreign key checks kembali
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // =====================
        // 1. CREATE USERS
        // =====================
        
        // Admin
        User::create([
            'name' => 'Admin One Spirit',
            'email' => 'admin@onespirit.com',
            'password' => bcrypt('admin123'),
            'phone_number' => '081234567890',
            'address' => 'Jl. Raya No. 1, Jakarta',
            'role' => 'admin',
        ]);

        // Customer tetap
        $customers = [
            ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'phone' => '081234567001'],
            ['name' => 'Siti Rahayu', 'email' => 'siti@gmail.com', 'phone' => '081234567002'],
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad@gmail.com', 'phone' => '081234567003'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@gmail.com', 'phone' => '081234567004'],
            ['name' => 'Hendra Wijaya', 'email' => 'hendra@gmail.com', 'phone' => '081234567005'],
        ];

        foreach ($customers as $cust) {
            User::create([
                'name' => $cust['name'],
                'email' => $cust['email'],
                'password' => bcrypt('password'),
                'phone_number' => $cust['phone'],
                'address' => 'Jl. Contoh No. ' . rand(1, 100),
                'role' => 'user',
            ]);
        }

        // User dummy tambahan
        User::factory(5)->create();

        // =====================
        // 2. CREATE MOBIL ELF
        // =====================
        
        $mobils = [
            ['nama' => 'Toyota Hiace Commuter', 'plat' => 'B 1234 ABC', 'kapasitas' => 14, 'harga' => 800000, 'status' => 'tersedia'],
            ['nama' => 'Toyota Hiace Commuter', 'plat' => 'B 1235 ABC', 'kapasitas' => 14, 'harga' => 800000, 'status' => 'tersedia'],
            ['nama' => 'Mitsubishi Rosa', 'plat' => 'B 2234 BCD', 'kapasitas' => 15, 'harga' => 750000, 'status' => 'tersedia'],
            ['nama' => 'Mitsubishi Rosa', 'plat' => 'B 2235 BCD', 'kapasitas' => 15, 'harga' => 750000, 'status' => 'dipesan'],
            ['nama' => 'Isuzu Elf NLR', 'plat' => 'D 3234 CDE', 'kapasitas' => 12, 'harga' => 650000, 'status' => 'tersedia'],
            ['nama' => 'Isuzu Elf NLR', 'plat' => 'D 3235 CDE', 'kapasitas' => 12, 'harga' => 650000, 'status' => 'tersedia'],
            ['nama' => 'Hino Dutro', 'plat' => 'F 4234 EFG', 'kapasitas' => 16, 'harga' => 850000, 'status' => 'tersedia'],
            ['nama' => 'Nissan NV350', 'plat' => 'B 5234 FGH', 'kapasitas' => 14, 'harga' => 900000, 'status' => 'tersedia'],
            ['nama' => 'Mercedes Sprinter', 'plat' => 'B 6234 GHI', 'kapasitas' => 15, 'harga' => 1200000, 'status' => 'perbaikan'],
            ['nama' => 'Hyundai H-1', 'plat' => 'B 7234 HIJ', 'kapasitas' => 12, 'harga' => 700000, 'status' => 'tersedia'],
        ];

        foreach ($mobils as $mobil) {
            MobilElf::create([
                'nama_mobil' => $mobil['nama'],
                'plat_nomor' => $mobil['plat'],
                'kapasitas_penumpang' => $mobil['kapasitas'],
                'harga_sewa_per_hari' => $mobil['harga'],
                'status' => $mobil['status'],
                'deskripsi' => 'Mobil ELF ' . $mobil['nama'] . ' kapasitas ' . $mobil['kapasitas'] . ' orang. Fasilitas: AC, TV, WiFi, Kursi Reclining.',
                'foto_mobil' => 'elf-' . strtolower(str_replace(' ', '-', $mobil['nama'])) . '.jpg',
            ]);
        }

        // =====================
        // 3. CREATE SUPIR
        // =====================
        
        $supirs = [
            ['nama' => 'Pak Ahmad', 'hp' => '081234567101', 'sim' => '1234567890', 'status' => 'tersedia'],
            ['nama' => 'Pak Budi', 'hp' => '081234567102', 'sim' => '1234567891', 'status' => 'tersedia'],
            ['nama' => 'Pak Chandra', 'hp' => '081234567103', 'sim' => '1234567892', 'status' => 'bertugas'],
            ['nama' => 'Pak Dedi', 'hp' => '081234567104', 'sim' => '1234567893', 'status' => 'tersedia'],
            ['nama' => 'Pak Eko', 'hp' => '081234567105', 'sim' => '1234567894', 'status' => 'tersedia'],
            ['nama' => 'Pak Farhan', 'hp' => '081234567106', 'sim' => '1234567895', 'status' => 'libur'],
            ['nama' => 'Pak Gunawan', 'hp' => '081234567107', 'sim' => '1234567896', 'status' => 'tersedia'],
            ['nama' => 'Pak Hadi', 'hp' => '081234567108', 'sim' => '1234567897', 'status' => 'tersedia'],
        ];

        foreach ($supirs as $supir) {
            Supir::create([
                'nama_lengkap' => $supir['nama'],
                'nomor_hp' => $supir['hp'],
                'nomor_sim' => $supir['sim'],
                'alamat' => 'Jl. Driver No. ' . rand(1, 50),
                'status' => $supir['status'],
                'foto_supir' => 'driver-default.jpg',
            ]);
        }

        // =====================
        // 4. CREATE BOOKINGS
        // =====================
        
        $bookings = [
            ['user' => 2, 'mobil' => 1, 'supir' => 1, 'tgl_mulai' => '2026-05-05', 'tgl_akhir' => '2026-05-07', 'harga' => 2400000, 'status' => 'completed', 'catatan' => 'Trip ke Bandung'],
            ['user' => 3, 'mobil' => 2, 'supir' => 2, 'tgl_mulai' => '2026-05-10', 'tgl_akhir' => '2026-05-12', 'harga' => 2400000, 'status' => 'completed', 'catatan' => 'Trip ke Yogyakarta'],
            ['user' => 4, 'mobil' => 3, 'supir' => 3, 'tgl_mulai' => '2026-05-15', 'tgl_akhir' => '2026-05-17', 'harga' => 2250000, 'status' => 'completed', 'catatan' => 'Trip ke Surabaya'],
            ['user' => 5, 'mobil' => 4, 'supir' => 4, 'tgl_mulai' => '2026-05-20', 'tgl_akhir' => '2026-05-22', 'harga' => 2250000, 'status' => 'confirmed', 'catatan' => 'Trip ke Malang'],
            ['user' => 6, 'mobil' => 5, 'supir' => 5, 'tgl_mulai' => '2026-06-01', 'tgl_akhir' => '2026-06-03', 'harga' => 1950000, 'status' => 'pending', 'catatan' => 'Trip ke Bali'],
            ['user' => 2, 'mobil' => 6, 'supir' => 1, 'tgl_mulai' => '2026-06-05', 'tgl_akhir' => '2026-06-07', 'harga' => 1950000, 'status' => 'pending', 'catatan' => 'Trip ke Lombok'],
        ];

        foreach ($bookings as $booking) {
            Booking::create([
                'user_id' => $booking['user'],
                'mobil_elf_id' => $booking['mobil'],
                'supir_id' => $booking['supir'],
                'tanggal_mulai_sewa' => $booking['tgl_mulai'],
                'tanggal_akhir_sewa' => $booking['tgl_akhir'],
                'total_harga' => $booking['harga'],
                'status' => $booking['status'],
                'catatan_user' => $booking['catatan'],
                'catatan_admin' => null,
            ]);
        }

        // =====================
        // 5. CREATE REVIEWS
        // =====================
        
        $reviews = [
            ['booking' => 1, 'mobil' => 1, 'rating' => 5, 'komentar' => 'Mobil bersih, supir ramah dan tepat waktu. Sangat memuaskan!'],
            ['booking' => 2, 'mobil' => 2, 'rating' => 4, 'komentar' => 'Pelayanan baik, mobil nyaman. Hanya sedikit terlambat di pickup point.'],
            ['booking' => 3, 'mobil' => 3, 'rating' => 5, 'komentar' => 'Sopir sangat profesional dan helpful. Mobil ELF nya juga terawat baik.'],
            ['booking' => 4, 'mobil' => 4, 'rating' => 4, 'komentar' => 'Overall bagus, tapi AC sedikit kurang dingin.'],
            ['booking' => 5, 'mobil' => 5, 'rating' => 5, 'komentar' => 'Sangat recommend! Proses booking mudah, mobil bersih.'],
        ];

        foreach ($reviews as $review) {
            Review::create([
                'booking_id' => $review['booking'],
                'user_id' => 2, // Default user
                'mobil_elf_id' => $review['mobil'],
                'rating' => $review['rating'],
                'komentar' => $review['komentar'],
            ]);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin login: admin@onespirit.com / admin123');
    }
}

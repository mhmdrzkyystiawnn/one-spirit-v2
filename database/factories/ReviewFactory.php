<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\MobilElf;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $komentar = [
            'Pelayanan sangat baik, supir ramah dan mobil dalam kondisi prima.',
            'Pengalaman yang menyenangkan, akan sewa lagi di lain waktu.',
            'Mobil nyaman dan bersih, supir profesional.',
            'Harga sesuai dengan kualitas pelayanan yang diberikan.',
            'Rekomendasi untuk teman-teman yang butuh sewa mobil elf.',
            'Supir sangat menguasai jalan, perjalanan aman dan lancar.',
            'Mobil elf ini sangat cocok untuk acara keluarga kami.',
            'Pelayanan cepat dan responsif, terima kasih One Spirit.',
            'Armada terawat dengan baik, fasilitas lengkap.',
            'Pengalaman terbaik sewa mobil elf, akan repeat order.',
            'Supir sangat sabar dan membantu selama perjalanan.',
            'Mobil bersih dan wangi, sesuai dengan yang dijanjikan.',
            'Harga nego sangat reasonable, worth it banget.',
            'Tim One Spirit sangat profesional dalam melayani.',
            'Perjalanan wisata jadi lebih menyenangkan berkat supir yang asik.'
        ];

        return [
            'user_id' => User::factory(),
            'mobil_elf_id' => MobilElf::factory(),
            'booking_id' => Booking::factory(),
            'rating' => $this->faker->numberBetween(3, 5),
            'komentar' => $this->faker->randomElement($komentar),
        ];
    }
}

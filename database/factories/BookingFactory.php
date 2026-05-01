<?php

namespace Database\Factories;

use App\Models\MobilElf;
use App\Models\Supir;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalMulai = $this->faker->dateTimeBetween('now', '+30 days');
        $tanggalAkhir = $this->faker->dateTimeBetween($tanggalMulai, $tanggalMulai->format('Y-m-d H:i:s') . ' +7 days');

        return [
            'user_id' => User::factory(),
            'mobil_elf_id' => MobilElf::factory(),
            'supir_id' => Supir::factory(),
            'tanggal_mulai_sewa' => $tanggalMulai,
            'tanggal_akhir_sewa' => $tanggalAkhir,
            'total_harga' => $this->faker->numberBetween(1000000, 10000000),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
        ];
    }
}

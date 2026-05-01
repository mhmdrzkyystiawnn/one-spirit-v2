<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MobilElf>
 */
class MobilElfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mobilNames = [
            'Toyota Hiace Commuter',
            'Mitsubishi Rosa',
            'Isuzu Elf NLR 55',
            'Hino Dutro',
            'Nissan NV350 Caravan',
            'Suzuki Carry',
            'Daihatsu Gran Max',
            'Mercedes-Benz Sprinter',
            'Volkswagen Crafter',
            'Ford Transit',
            'Hyundai H-1 Starex',
            'Kia Carnival',
            'Toyota Alphard',
            'Honda Odyssey',
            'Mazda Bongo'
        ];

        $fasilitas = [
            'AC, TV, WiFi',
            'AC, Musik, Kursi Nyaman',
            'AC, TV, Musik, WiFi',
            'AC, Kursi Reclining, Musik',
            'AC, TV, Kursi Nyaman, WiFi',
            'AC, Musik, WiFi, Charger',
            'AC, TV, Musik, Kursi Reclining',
            'AC, TV, WiFi, Musik, Charger',
            'AC, Kursi Nyaman, Musik, WiFi',
            'AC, TV, Kursi Reclining, Charger'
        ];

        return [
            'nama_mobil' => $this->faker->randomElement($mobilNames),
            'kapasitas_penumpang' => $this->faker->numberBetween(12, 20),
            'deskripsi' => $this->faker->randomElement($fasilitas),
            'foto_mobil' => 'images/default-car.jpg', // Placeholder, bisa diganti dengan gambar asli
            'status' => $this->faker->randomElement(['tersedia', 'dipesan', 'perbaikan']),
            'plat_nomor' => strtoupper($this->faker->bothify('?? #### ??')),
            'harga_sewa_per_hari' => $this->faker->numberBetween(500000, 1500000),
        ];
    }
}

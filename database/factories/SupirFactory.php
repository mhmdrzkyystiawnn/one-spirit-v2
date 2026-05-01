<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supir>
 */
class SupirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'nomor_hp' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'nomor_sim' => $this->faker->unique()->numerify('##########'),
            'status' => $this->faker->randomElement(['tersedia', 'bertugas', 'libur']),
        ];
    }
}

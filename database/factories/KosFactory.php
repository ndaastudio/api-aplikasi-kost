<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kos>
 */
class KosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kos' => $this->faker->name,
            'alamat' => $this->faker->address,
            'provinsi' => $this->faker->numberBetween(1, 34),
            'kota' => $this->faker->numberBetween(1, 100),
            'kecamatan' => $this->faker->citySuffix,
            'kelurahan' => $this->faker->streetSuffix,
            'jumlah_kamar' => $this->faker->numberBetween(1, 100),
        ];
    }
}

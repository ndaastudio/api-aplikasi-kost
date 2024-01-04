<?php

namespace Database\Factories;

use App\Models\Kos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kos_id' => $this->faker->numberBetween(1, Kos::count()),
            'nama_kamar' => $this->faker->name,
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}

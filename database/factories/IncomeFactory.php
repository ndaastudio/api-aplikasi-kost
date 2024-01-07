<?php

namespace Database\Factories;

use App\Models\Kos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
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
            'bulan' => $this->faker->numberBetween(1, 12),
            'tahun' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y'),
            'total' => $this->faker->numberBetween(100000, 1000000)
        ];
    }
}

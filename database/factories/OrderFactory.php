<?php

namespace Database\Factories;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kamar_id' => $this->faker->numberBetween(1, Kamar::count()),
            'nomor_order' => $this->faker->unique()->numerify('ORD-###'),
            'tanggal_masuk' => $this->faker->date(),
            'durasi' => $this->faker->numberBetween(1, 12),
            'keterangan' => $this->faker->sentence(4),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}

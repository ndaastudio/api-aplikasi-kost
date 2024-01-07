<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 10),
            'nomor_invoice' => $this->faker->unique()->numerify('INV/########/KG##/###'),
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'jumlah' => $this->faker->numberBetween(100000, 1000000),
            'bukti' => $this->faker->imageUrl(640, 480),
        ];
    }
}

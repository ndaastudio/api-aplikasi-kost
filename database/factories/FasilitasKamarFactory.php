<?php

namespace Database\Factories;

use App\Models\Fasilitas;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FasilitasKamar>
 */
class FasilitasKamarFactory extends Factory
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
            'fasilitas_id' => $this->faker->numberBetween(1, Fasilitas::count()),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'keterangan' => $this->faker->text,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Identitas>
 */
class IdentitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, User::count()),
            'nama' => $this->faker->name,
            'telepon' => $this->faker->phoneNumber,
            'whatsapp' => $this->faker->phoneNumber,
        ];
    }
}

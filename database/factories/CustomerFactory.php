<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1, Order::count()),
            'nama_customer' => $this->faker->name,
            'telepon' => $this->faker->phoneNumber,
            'whatsapp' => $this->faker->phoneNumber,
            'pekerjaan' => $this->faker->jobTitle,
            'ktp' => $this->faker->creditCardNumber,
        ];
    }
}

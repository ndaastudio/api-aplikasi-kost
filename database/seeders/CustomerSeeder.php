<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        collect([
            [
                'order_id' => 1,
                'nama_customer' => $faker->name,
                'telepon' => $faker->phoneNumber,
                'whatsapp' => $faker->phoneNumber,
                'pekerjaan' => $faker->jobTitle,
                'ktp' => $faker->creditCardNumber,
            ],
            [
                'order_id' => 1,
                'nama_customer' => $faker->name,
                'telepon' => $faker->phoneNumber,
                'whatsapp' => $faker->phoneNumber,
                'pekerjaan' => $faker->jobTitle,
                'ktp' => $faker->creditCardNumber,
            ],
            [
                'order_id' => 3,
                'nama_customer' => $faker->name,
                'telepon' => $faker->phoneNumber,
                'whatsapp' => $faker->phoneNumber,
                'pekerjaan' => $faker->jobTitle,
                'ktp' => $faker->creditCardNumber,
            ],
            [
                'order_id' => 5,
                'nama_customer' => $faker->name,
                'telepon' => $faker->phoneNumber,
                'whatsapp' => $faker->phoneNumber,
                'pekerjaan' => $faker->jobTitle,
                'ktp' => $faker->creditCardNumber,
            ],
            [
                'order_id' => 5,
                'nama_customer' => $faker->name,
                'telepon' => $faker->phoneNumber,
                'whatsapp' => $faker->phoneNumber,
                'pekerjaan' => $faker->jobTitle,
                'ktp' => $faker->creditCardNumber,
            ],
        ])->each(function ($customer) {
            Customer::create($customer);
        });
    }
}

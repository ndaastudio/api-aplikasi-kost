<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        collect([
            [
                'kamar_id' => 1,
                'tanggal_masuk' => $faker->date(),
                'durasi' => random_int(1, 10),
                'keterangan' => $faker->sentence(4),
            ],
            [
                'kamar_id' => 2,
                'tanggal_masuk' => $faker->date(),
                'durasi' => random_int(1, 10),
                'keterangan' => $faker->sentence(4),
            ],
            [
                'kamar_id' => 3,
                'tanggal_masuk' => $faker->date(),
                'durasi' => random_int(1, 10),
                'keterangan' => $faker->sentence(4),
            ],
            [
                'kamar_id' => 4,
                'tanggal_masuk' => $faker->date(),
                'durasi' => random_int(1, 10),
                'keterangan' => $faker->sentence(4),
            ],
            [
                'kamar_id' => 5,
                'tanggal_masuk' => $faker->date(),
                'durasi' => random_int(1, 10),
                'keterangan' => $faker->sentence(4),
            ],
        ])->each(function ($order) {
            Order::create($order);
        });
    }
}

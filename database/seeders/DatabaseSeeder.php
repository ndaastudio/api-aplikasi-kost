<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Identitas;
use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Kos::factory(5)->create();

        $this->call(UserSeeder::class);

        Identitas::factory(3)->create();

        $this->call(KamarSeeder::class);

        $this->call(OrderSeeder::class);

        $this->call(CustomerSeeder::class);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Kos;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Identitas;
use App\Models\Invoice;
use App\Models\Order;
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
        Identitas::factory(User::count())->create();

        Kamar::factory(10)->create();

        Order::factory(10)->create();

        Customer::factory(20)->create();

        Invoice::factory(10)->create();
    }
}

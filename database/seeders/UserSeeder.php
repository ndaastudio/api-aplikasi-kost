<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'kos_id' => null,
                'username' => 'kingrup',
                'password' => 'kingrup2024',
                'level' => 1,
            ],
            [
                'kos_id' => null,
                'username' => 'kostgraha21',
                'password' => 'graha0812',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostplatinum',
                'password' => 'platinum717',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostsofia',
                'password' => 'sofia0102',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostmutia',
                'password' => 'mutia0404',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostpakhaji',
                'password' => 'haji2024',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostbuhajja',
                'password' => 'hajja2023',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostannisa',
                'password' => 'annisa0813',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kosthana',
                'password' => 'hana0809',
                'level' => 0,
            ],
        ])->each(function ($user) {
            User::create($user);
        });
    }
}

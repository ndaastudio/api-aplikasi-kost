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
                'password' => 'k0stgr4rh421',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostplatinum',
                'password' => 'k0stpl4t1num',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostsofia',
                'password' => 'k0sts0f14',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostmutia',
                'password' => 'k0stmut14',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostpakhaji',
                'password' => 'k0stp4kh4j1',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostbuhajja',
                'password' => 'k0stbuh4jj4',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kostannisa',
                'password' => 'k0st4nn1s4',
                'level' => 0,
            ],
            [
                'kos_id' => null,
                'username' => 'kosthana',
                'password' => 'k0sth4n4',
                'level' => 0,
            ],
        ])->each(function ($user) {
            User::create($user);
        });
    }
}

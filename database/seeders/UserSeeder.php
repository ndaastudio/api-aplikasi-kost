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
                'username' => 'pemilik_kost',
                'password' => 'pemilik_kost',
                'level' => 1,
            ],
            [
                'kos_id' => 1,
                'username' => 'penjaga_1',
                'password' => 'penjaga_1',
                'level' => 0,
            ],
            [
                'kos_id' => 2,
                'username' => 'penjaga_2',
                'password' => 'penjaga_2',
                'level' => 0,
            ],
        ])->each(function ($user) {
            User::create($user);
        });
    }
}

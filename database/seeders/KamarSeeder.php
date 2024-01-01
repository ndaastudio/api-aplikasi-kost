<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'kos_id' => 1,
                'nama_kamar' => 'Kamar Anggrek',
                'status' => random_int(0, 1),
            ],
            [
                'kos_id' => 2,
                'nama_kamar' => 'Kamar Melati',
                'status' => random_int(0, 1),
            ],
            [
                'kos_id' => 3,
                'nama_kamar' => 'Kamar Mawar',
                'status' => random_int(0, 1),
            ],
            [
                'kos_id' => 4,
                'nama_kamar' => 'Kamar Tulip',
                'status' => random_int(0, 1),
            ],
            [
                'kos_id' => 5,
                'nama_kamar' => 'Kamar Edelweis',
                'status' => random_int(0, 1),
            ],
        ])->each(function ($kamar) {
            Kamar::create($kamar);
        });
    }
}

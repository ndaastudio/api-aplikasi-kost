<?php

namespace App\Models;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kos extends Model
{
    use HasFactory;

    protected $table = 'kos';

    protected $fillable = [
        'nama_kos',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'jumlah_kamar',
    ];

    public function kamar(): HasMany
    {
        return $this->hasMany(Kamar::class);
    }

    public function store($data): object
    {
        return $this->create($data);
    }

    public function showAll(): object
    {
        return $this->all();
    }

    public function showById($id): object
    {
        return $this->with('kamar')->where('id', $id)->first();
    }

    public function destroyById($id): bool
    {
        $kos = $this->where('id', $id)->first();

        if (!$kos) {
            return false;
        }

        $kos->delete();
    }
}

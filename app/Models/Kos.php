<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kamar;
use App\Scopes\KosScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kos extends Model
{
    use HasFactory, SoftDeletes;

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

    protected static function booted(): void
    {
        static::addGlobalScope(new KosScope());
    }

    public function kamar(): HasMany
    {
        return $this->hasMany(Kamar::class);
    }

    public function penjaga(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function store($data): object
    {
        return $this->create($data);
    }

    public function showAll(): object
    {
        return $this->all();
    }

    public function showById($id): object|null
    {
        return $this->with(['kamar.order.customer', 'penjaga.identitas'])->where('id', $id)->first();
    }

    public function destroyById($id): bool
    {
        $kos = $this->where('id', $id)->first();

        if (!$kos) {
            return false;
        }

        return $kos->delete();
    }
}

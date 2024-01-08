<?php

namespace App\Models;

use App\Models\Kos;
use App\Models\Order;
use App\Models\FasilitasKamar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kamar';

    protected $fillable = [
        'kos_id',
        'nama_kamar',
        'status',
    ];

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class);
    }

    public function fasilitas(): HasMany
    {
        return $this->hasMany(FasilitasKamar::class);
    }

    public function showById($id): object|null
    {
        return $this->with(['kos', 'order.customer', 'fasilitas.fasilitas'])->where('id', $id)->first();
    }

    public function updateById($id, $data): bool
    {
        return $this->where('id', $id)->update($data);
    }
}

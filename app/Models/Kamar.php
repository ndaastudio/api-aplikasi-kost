<?php

namespace App\Models;

use App\Models\Kos;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}

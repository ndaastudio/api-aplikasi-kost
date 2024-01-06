<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoice';

    protected $fillable = [
        'order_id',
        'tanggal',
        'jumlah',
        'bukti',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function showAll(): object
    {
        return $this->with(['order.kamar.kos', 'order.customer'])->get();
    }

    public function showById($id): object|null
    {
        return $this->with(['order.kamar.kos', 'order.customer'])->where('id', $id)->first();
    }

    public function showByKosId($kosId): object
    {
        return $this->with(['order.kamar.kos', 'order.customer'])->whereHas('order.kamar.kos', function ($query) use ($kosId) {
            $query->where('id', $kosId);
        })->get();
    }
}

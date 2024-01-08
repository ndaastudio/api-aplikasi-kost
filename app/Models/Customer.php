<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer';

    protected $fillable = [
        'order_id',
        'nama_customer',
        'telepon',
        'whatsapp',
        'pekerjaan',
        'ktp',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function showByKosId($kosId): object
    {
        return $this->with('order')->whereHas('order.kamar', function ($query) use ($kosId) {
            $query->where('kos_id', $kosId);
        })->whereHas('order', function ($query) {
            $query->where('status', 1);
        })->get();
    }

    public function showAll(): object
    {
        return $this->with('order')->get();
    }

    public function showById($id): object|null
    {
        return $this->with(['order.kamar.kos', 'order.invoice'])->where('id', $id)->first();
    }

    public function store($data): bool|object
    {
        return $this->create($data);
    }
}
